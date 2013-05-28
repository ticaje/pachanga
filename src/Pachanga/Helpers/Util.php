<?php
namespace Pachanga\Helpers;

class Util
{
  static public function slugify($text)
  {
    // replace non letter or digits by -
    $text = preg_replace('#[^\\pL\d]+#u', '-', $text);

    // trim
    $text = trim($text, '-');

    // transliterate
    if (function_exists('iconv'))
    {
      $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
    }

    // lowercase
    $text = strtolower($text);

    // remove unwanted characters
    $text = preg_replace('#[^-\w]+#', '', $text);

    if (empty($text))
    {
      return 'n-a';
    }

    return $text;
  }

  /**
   * Generador aleatorio de descripciones.
   *
   * @return string
   */
  static public function getFrase()
  {
    $frases = array_flip(array(
      'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
      'Mauris ultricies nunc nec sapien tincidunt facilisis.',
      'Nulla scelerisque blandit ligula eget hendrerit.',
      'Sed malesuada, enim sit amet ultricies semper, elit leo lacinia massa, in tempus nisl ipsum quis libero.',
      'Aliquam molestie neque non augue molestie bibendum.',
      'Pellentesque ultricies erat ac lorem pharetra vulputate.',
      'Donec dapibus blandit odio, in auctor turpis commodo ut.',
      'Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.',
      'Nam rhoncus lorem sed libero hendrerit accumsan.',
      'Maecenas non erat eu justo rutrum condimentum.',
      'Suspendisse leo tortor, tempus in lacinia sit amet, varius eu urna.',
      'Phasellus eu leo tellus, et accumsan libero.',
      'Pellentesque fringilla ipsum nec justo tempus elementum.',
      'Aliquam dapibus metus aliquam ante lacinia blandit.',
      'Donec ornare lacus vitae dolor imperdiet vitae ultricies nibh congue.',
    ));

    $numeroFrases = rand(4, 7);

    return implode("\n", array_rand($frases, $numeroFrases));
  }
}
