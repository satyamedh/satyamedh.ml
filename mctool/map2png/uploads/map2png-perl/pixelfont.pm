package pixelfont;

use strict;
use vars qw($VERSION);
use GD;

$VERSION = 1.0;

# pixelfont.php
# 5x7 binary pixel mapped fixed font (alphanum only)
  
my %pixfont = (
  'A' => [31,40,72,40,31],
  'B' => [54,73,73,73,127],
  'C' => [34,65,65,65,62],
  'D' => [62,65,65,65,127],
  'E' => [65,73,73,73,127],
  'F' => [64,72,72,72,127],
  'G' => [47,73,65,65,62],
  'H' => [127,8,8,8,127],
  'I' => [65,65,127,65,65],
  'J' => [126,1,1,1,6],
  'K' => [99,20,8,8,127],
  'L' => [1,1,1,1,127],
  'M' => [127,32,16,32,127],
  'N' => [127,4,24,32,127],
  'O' => [62,65,65,65,62],
  'P' => [48,72,72,72,127],
  'Q' => [58,68,74,66,60],
  'R' => [55,72,72,72,127],
  'S' => [38,73,73,73,50],
  'T' => [64,64,127,64,64],
  'U' => [126,1,1,1,126],
  'V' => [124,2,1,2,124],
  'W' => [126,1,14,1,126],
  'X' => [99,20,8,20,99],
  'Y' => [96,16,15,16,96],
  'Z' => [97,81,73,69,67],
  '0' => [62,81,73,69,62],
  '1' => [1,1,127,65,33],
  '2' => [49,73,73,73,39],
  '3' => [54,73,73,65,34],
  '4' => [127,8,8,8,120],
  '5' => [70,73,73,73,122],
  '6' => [38,73,73,73,62],
  '7' => [112,72,68,67,64],
  '8' => [54,73,73,73,54],
  '9' => [62,73,73,73,50],
  'space' => [0,0,0,0,0],
  'apostrophe' => [0,192,224,32,0],
  'period' => [0,0,3,0,0],
  'dash' => [8,8,8,8,8],
  'default' => [8,8,8,8,8]
);

sub pf_letter {
  
  my ($px, $py, $char, $dir, $color, $image) = @_;
  
  # dir:
  # 1 -> vertical
  # 2 -> horizontal
  
  $char = uc $char;
  
  $char = 'space'      if ($char eq ' ');
  $char = 'apostrophe' if ($char eq "'");
  $char = 'period'     if ($char eq '.');
  $char = 'dash'       if ($char eq '-');
  $char = 'default'    if (!exists $pixfont{$char});

  my $x = $px;
  my $y = $py;
  if ($dir == 1) {
    for (my $byte = 0; $byte < 5; $byte++) {
      $x = $px;
      for (my $bit = 6; $bit >= 0; $bit--) {
        my $pixel = ($pixfont{$char}[$byte] >> $bit) & 0x01;
        $image->setPixel ($x, $y, $color) if ($pixel);
        $x++;
      }
      $y++;
    }
  } elsif ($dir == 2) {
    for (my $byte = 4; $byte >= 0; $byte--) {
      $y = $py;
      for (my $bit = 6; $bit >= 0; $bit--) {
        my $pixel = ($pixfont{$char}[$byte] >> $bit) & 0x01;
        $image->setPixel ($x, $y, $color) if ($pixel);
        $y++;
      }
      $x++;
    }
  }

}

sub pf_string {

  my ($px, $py, $text, $dir, $gap, $color, $image) = @_;
  
  my $y = $py;
  for (my $p = 0; $p < length $text; $p++) {
    my $char = substr($text,$p,1);
    pf_letter($px, $y, $char, $dir, $color, $image);
    if ($dir == 1) {
      $y -= 5 + $gap;
    }
    elsif ($dir == 2) {
      $px += 5 + $gap;
    }
  }

}

sub pf_strlen {

  my ($text, $gap) = @_;
  return (length $text) * (5 + $gap) - $gap;
  
}

1;
