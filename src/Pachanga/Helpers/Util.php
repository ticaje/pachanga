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

  static public function getUsername($nombre)
  {
    return Util::slugify($nombre);
  }
  /**
   * Generador aleatorio de nombres de personas.
   * Aproximadamente genera un 50% de hombres y un 50% de mujeres.
   *
   * @return string Nombre aleatorio generado para el usuario.
   */
  static public function getNombre()
  {
    // Los nombres más populares en España según el INE
    // Fuente: http://www.ine.es/daco/daco42/nombyapel/nombyapel.htm

    $hombres = array(
      'Antonio', 'José', 'Manuel', 'Francisco', 'Juan', 'David',
      'José Antonio', 'José Luis', 'Jesús', 'Javier', 'Francisco Javier',
      'Carlos', 'Daniel', 'Miguel', 'Rafael', 'Pedro', 'José Manuel',
      'Ángel', 'Alejandro', 'Miguel Ángel', 'José María', 'Fernando',
      'Luis', 'Sergio', 'Pablo', 'Jorge', 'Alberto'
    );
    $mujeres = array(
      'María Carmen', 'María', 'Carmen', 'Josefa', 'Isabel', 'Ana María',
      'María Dolores', 'María Pilar', 'María Teresa', 'Ana', 'Francisca',
      'Laura', 'Antonia', 'Dolores', 'María Angeles', 'Cristina', 'Marta',
      'María José', 'María Isabel', 'Pilar', 'María Luisa', 'Concepción',
      'Lucía', 'Mercedes', 'Manuela', 'Elena', 'Rosa María'
    );

    if (rand() % 2) {
      return $hombres[array_rand($hombres)];
    } else {
      return $mujeres[array_rand($mujeres)];
    }
  }

  /**
   * Generador aleatorio de apellidos de personas.
   *
   * @return string Apellido aleatorio generado para el usuario.
   */
  static public function getApellidos()
  {
    // Los apellidos más populares en España según el INE
    // Fuente: http://www.ine.es/daco/daco42/nombyapel/nombyapel.htm

    $apellidos = array(
      'García', 'González', 'Rodríguez', 'Fernández', 'López', 'Martínez',
      'Sánchez', 'Pérez', 'Gómez', 'Martín', 'Jiménez', 'Ruiz',
      'Hernández', 'Díaz', 'Moreno', 'Álvarez', 'Muñoz', 'Romero',
      'Alonso', 'Gutiérrez', 'Navarro', 'Torres', 'Domínguez', 'Vázquez',
      'Ramos', 'Gil', 'Ramírez', 'Serrano', 'Blanco', 'Suárez', 'Molina',
      'Morales', 'Ortega', 'Delgado', 'Castro', 'Ortíz', 'Rubio', 'Marín',
      'Sanz', 'Iglesias', 'Nuñez', 'Medina', 'Garrido'
    );

    return $apellidos[array_rand($apellidos)].' '.$apellidos[array_rand($apellidos)];
  }

  /**
   * Generador aleatorio de direcciones postales.
   *
   * @param  Ciudad $ciudad Objeto de la ciudad para la que se genera una dirección postal.
   * @return string         Dirección postal aleatoria generada para la tienda.
   */
  static public function getDireccion(Ciudad $ciudad)
  {
    $prefijos = array('Calle', 'Avenida', 'Plaza');
    $nombres = array(
      'Lorem', 'Ipsum', 'Sitamet', 'Consectetur', 'Adipiscing',
      'Necsapien', 'Tincidunt', 'Facilisis', 'Nulla', 'Scelerisque',
      'Blandit', 'Ligula', 'Eget', 'Hendrerit', 'Malesuada', 'Enimsit'
    );

    return $prefijos[array_rand($prefijos)].' '.$nombres[array_rand($nombres)].', '.rand(1, 100)."\n"
      .Util::getCodigoPostal().' '.$ciudad->getNombre();
  }

  /**
   * Generador aleatorio de códigos postales
   *
   * @return string Código postal aleatorio generado para la tienda.
   */
  static public function getCodigoPostal()
  {
    return sprintf('%02s%03s', rand(1, 52), rand(0, 999));
  }
}
