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

/* Jobs/index.twig */
class __TwigTemplate_d96a0a5d656cc1ef2413e998a37406b2a40e51a1c64b33d95029a4074d8ae528 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->blocks = [
            'content' => [$this, 'block_content'],
        ];
    }

    protected function doGetParent(array $context)
    {
        // line 1
        return "layout.twig";
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        $this->parent = $this->loadTemplate("layout.twig", "Jobs/index.twig", 1);
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 4
        echo "    <div class=\"row\">
        <h1>Jobs</h1>
        <table>
            <tr>
                <th>Job title</th>
                <th>Delete</th>
            </tr>
            ";
        // line 11
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["jobs"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["job"]) {
            // line 12
            echo "                <tr>
                    <td>";
            // line 13
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["job"], "title", [], "any", false, false, false, 13), "html", null, true);
            echo "</td>
                    <td><a href=\"/primer-proyecto-php/jobs/delete?id=";
            // line 14
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["job"], "id", [], "any", false, false, false, 14), "html", null, true);
            echo "\">Delete</a></td>
                </tr>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['job'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 17
        echo "        </table>
    </div>
";
    }

    public function getTemplateName()
    {
        return "Jobs/index.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  79 => 17,  70 => 14,  66 => 13,  63 => 12,  59 => 11,  50 => 4,  46 => 3,  35 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("{%  extends \"layout.twig\" %}

{% block content %}
    <div class=\"row\">
        <h1>Jobs</h1>
        <table>
            <tr>
                <th>Job title</th>
                <th>Delete</th>
            </tr>
            {% for job in jobs %}
                <tr>
                    <td>{{ job.title }}</td>
                    <td><a href=\"/primer-proyecto-php/jobs/delete?id={{ job.id }}\">Delete</a></td>
                </tr>
            {% endfor %}
        </table>
    </div>
{%  endblock %}", "Jobs/index.twig", "C:\\xampp\\htdocs\\primer-proyecto-php\\views\\Jobs\\index.twig");
    }
}
