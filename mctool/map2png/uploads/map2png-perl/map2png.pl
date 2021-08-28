#!/usr/bin/perl

use strict;
use MapColor;
use GD;
use IO::Uncompress::Gunzip qw(gunzip $GunzipError);
use File::Basename;

my $empty = 0;

if ($ARGV[0] eq '') {
  print "map2png.pl <map_####.dat>\n";
  exit;
}
my $fn = $ARGV[0];

my $fh = new IO::File "<$fn" || die "Cannot open $fn: $!\n" ;
my $raw;
gunzip $fh => \$raw || die "gunzip failed: $GunzipError\n";
undef $fh;

my $cpos = 10 + index $raw, 'colors';
my $cdata = substr $raw, $cpos, 16384;
my $clen = length $cdata;

my $img = new GD::Image(128,128,1);

# build color map
my @c;
my %p = MapColor::createPalette();
foreach my $i (sort {$a<=>$b} keys %p) {
  $c[$i] = $img->colorAllocate ($p{$i}[0], $p{$i}[1], $p{$i}[2]);
}

if ($cdata) {
  for (my $y = 0; $y <= 127; $y++) {
    for (my $x = 0; $x <= 127; $x++) {
      my $cid = unpack ('C',substr ($cdata, $y * 128 + $x, 1));
      # print "$cid ";
      $img->setPixel ($x, $y, $c[$cid]);
      $empty++ if ($cid == 0);
    }
  }
  printf "Unplotted pixels: %d/%d\nMap completion: %0.2f%%\n",
         $empty, $clen, 100 * ($clen - $empty) / $clen;
  my $png = $img->png;
  my ($base,$path,$ext) = fileparse($fn,'.dat');
  my $pf = $path . $base . ".png";
  open my $ph, ">", $pf || die "unable to save image $pf: $!\n";
  binmode $ph;
  print $ph $png;
  close $ph;
  print "created image $pf\n";
} else {
  print "failed to read file!";
  exit;
}
