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
class __TwigTemplate_a95cfa4995e5b963014582c3045528f2 extends Template
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
                <th class=\"center\">Status</th>
                <th class=\"center\">Due Date</th>
            </tr>
        </thead>
        <tbody>
            ";
        // line 24
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["invoices"] ?? null));
        $context['_iterated'] = false;
        foreach ($context['_seq'] as $context["_key"] => $context["invoice"]) {
            // line 25
            echo "                <tr>
                    <td class=\"center\">";
            // line 26
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["invoice"], "invoiceNumber", [], "any", false, false, false, 26), "html", null, true);
            echo "</td>
                    <td class=\"center\">";
            // line 27
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["invoice"], "amount", [], "any", false, false, false, 27), "html", null, true);
            echo "</td>
                    <td class=\"center\">
                        ";
            // line 29
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["invoice"], "status", [], "any", false, false, false, 29), "html", null, true);
            echo "
                    </td>
                    <td class=\"center\">";
            // line 31
            ((twig_test_empty(twig_get_attribute($this->env, $this->source, $context["invoice"], "dueDate", [], "any", false, false, false, 31))) ? (print ("N/A")) : (print (twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["invoice"], "dueDate", [], "any", false, false, false, 31), "html", null, true))));
            echo "</td>
                </tr>
            ";
            $context['_iterated'] = true;
        }
        if (!$context['_iterated']) {
            // line 34
            echo "                <tr class=\"center\"><td colspan=\"4\">No invoices Found</td></tr>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['invoice'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 36
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
        return array (  99 => 36,  92 => 34,  84 => 31,  79 => 29,  74 => 27,  70 => 26,  67 => 25,  62 => 24,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "invoices/index.twig", "/var/www/views/invoices/index.twig");
    }
}
