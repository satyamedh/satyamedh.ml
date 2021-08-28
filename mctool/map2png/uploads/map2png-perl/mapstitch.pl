#!/usr/bin/perl

use strict;
use MapColor;
use GD;
use IO::Uncompress::Gunzip qw(gunzip $GunzipError);
use File::Basename;
use pixelfont;

$| = 1;

if ($ARGV[1] eq '') {
  print "mapstitch <config.txt> <image.png>\n";
  exit;
}

my ($cfgf, $pngf) = @ARGV;

#config vars
my $mw;
my $mh;
my $gap;
my $showids;
my %ids;

my @c;
my %p = MapColor::createPalette();
my $raw;

# initialization
readconf ($cfgf);
my $iw = $mw * 128 + ($mw - 1) * $gap;
my $ih = $mh * 128 + ($mh - 1) * $gap;
printf "%dx%d maps, %dx%d total resolution\n", $mw, $mh, $iw, $ih;
# initialize canvas
my $img = new GD::Image($iw, $ih, 1);
#my ($w, $h) = $img->getBounds;
#print "$w x $h\n"; exit;
my $pfcol = $img->colorAllocate (255, 0, 0);
# initialize colors
foreach my $i (sort {$a<=>$b} keys %p) {
  $c[$i] = $img->colorAllocate ($p{$i}[0], $p{$i}[1], $p{$i}[2]);
}

sub readconf {
  # in: path
  # out: [sets vars]
  my ($fn) = @_;
  die "config $fn not found, exiting." if (! -f $fn);
  my $z = 0;
  open my $ch, "<", $fn || die "unable to open config $cfgf: $!\n";
  while (my $ln = <$ch>) {
    chomp $ln;
    my ($opt,$d) = split /=/, $ln;
    $opt = lc $opt;
    if      ($opt eq 'width') { $mw = $d;      }
    elsif ($opt eq 'height')  { $mh = $d;      }
    elsif ($opt eq 'gap')     { $gap = $d;     }
    elsif ($opt eq 'showids') { $showids = $d; }
    elsif ($opt eq 'ids') {
      my @i = split /,/, $d;
      for (my $x = 0; $x < scalar(@i); $x++) {
        $ids{$z}[$x] = $i[$x];
      }
      $z++;
    } else {
      print "unrecognized config option $opt\n";
    }
  }
  close $ch;
}

sub fetchmap {
  # in: file name
  # out: raw NBT
  my ($fn) = @_;
  my $fh = new IO::File "<$fn" || die "Cannot open $fn: $!\n" ;
  # my $raw;
  gunzip $fh => \$raw || die "gunzip failed: $GunzipError\n";
  undef $fh;
  #return \$raw;
}

sub plotmap {
  # in: image, base x, base y, map data
  # out: none
  my ($bx, $by, $map) = @_;
  
  my $cpos = 10 + (index $map, 'colors');
  
  for (my $y = 0; $y <= 127; $y++) {
    for (my $x = 0; $x <= 127; $x++) {
      my $cid = unpack ('C', substr ($map, $y * 128 + $x + $cpos, 1));
      if (!defined $c[$cid]) { die "invalid color $cid"; }
      $img->setPixel ($bx + $x, $by + $y, $c[$cid]);
    }
  }
  
}

# main()
for (my $my = 0; $my < $mh; $my++) {
  for (my $mx = 0; $mx < $mw; $mx++) {
    my $mapid = $ids{$my}[$mx];
    if (($mapid ne '') && ($mapid >= 0)) {
      my $mapf = sprintf "map_%d.dat", $mapid;
      if (-f $mapf) {
        #my $map = fetchmap ($mapf);
        fetchmap ($mapf);
        my $bx = $mx * 128 + ($mx * $gap);
        my $by = $my * 128 + ($my * $gap);
        plotmap ($bx, $by, $raw);
        if ($showids) {
          pixelfont::pf_string ($bx + 1, $by + 1, "$mapid", 2, 1, $pfcol, $img);
        }
      }
    }
    print ".";
  }
  print "\n";
}

# finish image
print "Creating image... ";
my $png = $img->png;
open my $ph, ">", $pngf || die "unable to write image $pngf: $!\n";
binmode $ph;
print $ph $png;
close $ph;
print "done.\n";
