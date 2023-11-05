<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* invoices/index.twig */
class __TwigTemplate_bfc060ca0ce85a47bd6c3ade400891f3 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <title>Invoices</title>
    <link rel=\"stylesheet\" href=\"https://cdn.jsdelivr.net/npm/water.css@2/out/water.min.css\">
    <link rel=\"stylesheet\" href=\"/css/styles.css\">
</head>
<body>
    <h1>Invoices</h1>
    <hr>

    <table>
        <thead>
            <tr>
                <th class=\"center\">Invoice #</th>
                <th class=\"center\">Amount</th>
                <th class=\"center\">Due Date</th>
            </tr>
        </thead>
        <tbody>
            ";
        // line 23
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["invoices"] ?? null));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["invoice"]) {
            // line 24
            echo "                <tr>
                    <td class=\"center\">";
            // line 25
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["invoice"], "invoiceNumber", [], "any", false, false, false, 25), "html", null, true);
            echo "</td>
                    <td class=\"center\">";
            // line 26
            echo twig_escape_filter($this->env, $this->extensions['Twig\Extra\Intl\IntlExtension']->formatCurrency(twig_get_attribute($this->env, $this->source, $context["invoice"], "amount", [], "any", false, false, false, 26), "USD"), "html", null, true);
            echo "</td>
                    <td class=\"center\">";
            // line 27
            ((twig_test_empty(twig_get_attribute($this->env, $this->source, $context["invoice"], "dueDate", [], "any", false, false, false, 27))) ? (print ("N/A")) : (print (twig_escape_filter($this->env, twig_date_format_filter($this->env, twig_get_attribute($this->env, $this->source, $context["invoice"], "dueDate", [], "any", false, false, false, 27), "Y-m-d"), "html", null, true))));
            echo "</td>
                </tr>
            ";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 30
            echo "                <tr class=\"center\"><td colspan=\"4\">No invoices Found</td></tr>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['invoice'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 32
        echo "        </tbody>
    </table>
</body>
</html>";
    }

    public function getTemplateName()
    {
        return "invoices/index.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  92 => 32,  85 => 30,  77 => 27,  73 => 26,  69 => 25,  66 => 24,  61 => 23,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "invoices/index.twig", "/var/www/views/invoices/index.twig");
    }
}
