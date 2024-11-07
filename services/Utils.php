<?php

namespace services;

use DateTime;
use IntlDateFormatter;

/**
 * Utility class : this class only contains static methods.
 * Example : Utils::redirect('home');
 */
class Utils {
    const DATE_SHORT_FORMAT = 0;
    const DATE_FULL_FORMAT = 1;
    const DATE_HTML_VALUE = 2;
    const DATETIME_FORMAT = 3;

    public static function formatDate(int $format, DateTime $date): string
    {
        return match ($format) {
            self::DATE_SHORT_FORMAT => $date->format("d/m/Y"),
            self::DATE_FULL_FORMAT => self::convertDateToFrenchFormat($date),
            self::DATE_HTML_VALUE => $date->format("Y-m-d"),
            self::DATETIME_FORMAT => $date->format("Y-m-d H:i:s"),
        };
    }


    /**
     * Convert a date to a format like "15 juillet 2023" in French.
     * @param DateTime $date : date to convert.
     * @return string : converted date.
     */
    public static function convertDateToFrenchFormat(DateTime $date) : string
    {
        $dateFormatter = new IntlDateFormatter('fr_FR', IntlDateFormatter::FULL, IntlDateFormatter::FULL);
        $dateFormatter->setPattern('d MMMM Y');
        return $dateFormatter->format($date);
    }

    /**
     * Redirect to an url.
     * @param string $action : Route actions.
     * @param array $params : Optional, action params in the format : ['param1' => 'value1', 'param2' => 'value2']
     * @return void
     */
    public static function redirect(string $action, array $params = []) : void
    {
        $url = "index.php?action=$action";

        // Stocker les paramètres dans la session
        $_SESSION['post_data'] = $params;

        // Construire l'URL cible
        $url = "index.php?action=$action";

        header("Location: $url");
        exit();
    }

    /**
     * Returns js code to insert as button attribute.
     * Opens a "confirm" modal, and does the action only if user clicked "ok".
     * @param string $message : Popup message.
     * @return string : js code to insert in the button.
     */
    public static function askConfirmation(string $message) : string
    {
        return "onclick=\"return confirm('$message');\"";
    }

    /**
     * This method protects a string against XSS attacks.
     * Moreover, it transforms line breaks in <p> tags for a better display.
     * @param string $string : string to protect.
     * @return string : protected string.
     */
    public static function format(string $string) : string
    {
        $finalString = htmlspecialchars($string, ENT_QUOTES);

        $lines = explode("\n", $finalString);

        $finalString = "";
        foreach ($lines as $line) {
            if (trim($line) != "") {
                $finalString .= "<p>$line</p>";
            }
        }
        
        return $finalString;
    }

    /**
     * This method permits to get a variable from $_REQUEST.
     * If this variable isn't defined, we return a default value (null by default).
     * @param string $variableName : name of the variable to get.
     * @param mixed $defaultValue : default value.
     * @return mixed
     */
    public static function request(string $variableName, mixed $defaultValue = null) : mixed
    {
        if(isset($_REQUEST[$variableName])) {
            return $_REQUEST[$variableName];
        } elseif (isset($parameters[$variableName])) {
            return $parameters[$variableName];
        } else {
            return $defaultValue;
        }
    }


    /**
     * !! TO IMPROVE !!
     * Method to generate "arrows" to sort a column.
     * @param string $column column on which the arrows are generated.
     * @param array $parameters param to tell which column is sorted now, and in which order : ['column' => $columnName, 'order' => asc/desc]
     * @return string
     */
    public static function generateArrows(string $column, array $parameters) : string
    {
        if ($column == $parameters['column']) {
            if ($parameters['order'] == 'asc') {
                return "
                    <a href='index.php?action=monitoring&column={$column}&order=asc'><i class='fa-solid fa-caret-up' style='color: #d79922;'></i></a>
                    <a href='index.php?action=monitoring&column={$column}&order=desc'><i class='fa-solid fa-caret-down' style='color: #efe1ba;'></i></a>
                ";
            }
            if ($parameters['order'] == 'desc') {
                return "
                    <a href='index.php?action=monitoring&column={$column}&order=asc'><i class='fa-solid fa-caret-up' style='color: #efe1ba;'></i></a>
                    <a href='index.php?action=monitoring&column={$column}&order=desc'><i class='fa-solid fa-caret-down' style='color: #d79922;'></i></a>
                ";
            }
        }
        return "
            <a href='index.php?action=monitoring&column={$column}&order=asc'><i class='fa-solid fa-caret-up' style='color: #efe1ba;'></i></a>
            <a href='index.php?action=monitoring&column={$column}&order=desc'><i class='fa-solid fa-caret-down' style='color: #efe1ba;'></i></a>
        ";
    }

    public static function betterDump(...$var): void
    {
        echo '<pre>';
        var_dump($var);
        echo '</pre>';
    }
}
