<?php

namespace Pachanga\AnuncioBundle\Twig\Extension;

use Symfony\Component\Translation\TranslatorInterface;

/**
 * Extensión propia de Twig con filtros y funciones útiles para
 * la aplicación
 */
class PachangaExtension extends \Twig_Extension
{
    private $translator;

    public function __construct(TranslatorInterface $translator = null)
    {
        $this->translator = $translator;
    }

    public function getTranslator()
    {
        return $this->translator;
    }

    public function getFilters()
    {
        return array(
            'display_as_list' => new \Twig_Filter_Method($this, 'displayAsList', array('is_safe' => array('html'))),
            'fecha' => new \Twig_Filter_Method($this, 'fecha'),
        );
    }

    public function getFunctions()
    {
        return array(
            'descuento' => new \Twig_Function_Method($this, 'descuento')
        );
    }

    /**
     * Muestra como una lista HTML el contenido de texto al que se
     * aplica el filtro. Cada "\n" genera un nuevo elemento de
     * la lista.
     *
     * @param string $value El texto que se transforma
     * @param string $tipo  Tipo de lista a generar ('ul', 'ol')
     */
    public function displayAsList($value, $tipo='ul')
    {
        $html = "<".$tipo.">".PHP_EOL;
        $html .= "  <li>".str_replace(PHP_EOL, "</li>".PHP_EOL."  <li>", $value)."</li>".PHP_EOL;
        $html .= "</".$tipo.">".PHP_EOL;

        return $html;
    }

    /**
     * Formatea la date indicada según las características del locale seleccionado.
     * Se utiliza para mostrar correctamente las dates en el idioma de cada usuario.
     *
     * @param string $date        Objeto que representa la date original
     * @param string $dateFormat Formato con el que se muestra la date
     * @param string $hourFormat  Formato con el que se muestra la hora
     * @param string $locale       El locale al que se traduce la date
     */
    public function fecha($date, $dateFormat = 'medium', $hourFormat = 'none', $locale = null)
    {
        // Código copiado de
        //   https://github.com/thaberkern/symfony/blob
        //   /b679a23c331471961d9b00eb4d44f196351067c8
        //   /src/Symfony/Bridge/Twig/Extension/TranslationExtension.php

        // Formatos: http://www.php.net/manual/en/class.intldateformatter.php#intl.intldateformatter-constants
        $formats = array(
            // Fecha/Hora: (no se muestra nada)
            'none'   => \IntlDateFormatter::NONE,
            // Fecha: 12/13/52  Hora: 3:30pm
            'short'  => \IntlDateFormatter::SHORT,
            // Fecha: Jan 12, 1952  Hora:
            'medium' => \IntlDateFormatter::MEDIUM,
            // Fecha: January 12, 1952  Hora: 3:30:32pm
            'long'   => \IntlDateFormatter::LONG,
            // Fecha: Tuesday, April 12, 1952 AD  Hora: 3:30:42pm PST
            'full'   => \IntlDateFormatter::FULL,
        );

        $formater = \IntlDateFormatter::create(
            $locale != null ? $locale : $this->getTranslator()->getLocale(),
            $formats[$dateFormat],
            $formats[$hourFormat]
        );

        if ($date instanceof \DateTime) {
            return $formater->format($date);
        } else {
            return $formater->format(new \DateTime($date));
        }
    }

    public function getName()
    {
        return 'pachanga';
    }
}
