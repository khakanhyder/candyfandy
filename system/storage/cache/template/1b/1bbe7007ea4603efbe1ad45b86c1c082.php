<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* catalog/view/template/common/header.twig */
class __TwigTemplate_eb6b1a0e01a1becd6ec77e6b1d78f091 extends Template
{
    private Source $source;
    /**
     * @var array<string, Template>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 1
        yield "<!DOCTYPE html>
<html dir=\"";
        // line 2
        yield ($context["direction"] ?? null);
        yield "\" lang=\"";
        yield ($context["lang"] ?? null);
        yield "\">
<head>
  <meta charset=\"UTF-8\"/>
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
  <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
  <title>";
        // line 7
        yield ($context["title"] ?? null);
        yield "</title>
  <base href=\"";
        // line 8
        yield ($context["base"] ?? null);
        yield "\"/>
  ";
        // line 9
        if (($context["description"] ?? null)) {
            // line 10
            yield "    <meta name=\"description\" content=\"";
            yield ($context["description"] ?? null);
            yield "\"/>
  ";
        }
        // line 12
        yield "  ";
        if (($context["keywords"] ?? null)) {
            // line 13
            yield "    <meta name=\"keywords\" content=\"";
            yield ($context["keywords"] ?? null);
            yield "\"/>
  ";
        }
        // line 15
        yield "  <script src=\"";
        yield ($context["jquery"] ?? null);
        yield "\" type=\"text/javascript\"></script>
  <link href=\"";
        // line 16
        yield ($context["bootstrap"] ?? null);
        yield "\" type=\"text/css\" rel=\"stylesheet\" media=\"screen\"/>
  <link href=\"";
        // line 17
        yield ($context["icons"] ?? null);
        yield "\" rel=\"stylesheet\" type=\"text/css\"/>
  <link href=\"";
        // line 18
        yield ($context["stylesheet"] ?? null);
        yield "\" type=\"text/css\" rel=\"stylesheet\"/>
  <script src=\"catalog/view/javascript/common.js\" type=\"text/javascript\"></script>
  ";
        // line 20
        if (($context["icon"] ?? null)) {
            // line 21
            yield "    <link rel=\"icon\" href=\"";
            yield ($context["icon"] ?? null);
            yield "\" type=\"image/png\">
  ";
        }
        // line 23
        yield "  ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["styles"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["style"]) {
            // line 24
            yield "    <link href=\"";
            yield CoreExtension::getAttribute($this->env, $this->source, $context["style"], "href", [], "any", false, false, false, 24);
            yield "\" type=\"text/css\" rel=\"";
            yield CoreExtension::getAttribute($this->env, $this->source, $context["style"], "rel", [], "any", false, false, false, 24);
            yield "\" media=\"";
            yield CoreExtension::getAttribute($this->env, $this->source, $context["style"], "media", [], "any", false, false, false, 24);
            yield "\"/>
  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['style'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 26
        yield "  ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["scripts"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["script"]) {
            // line 27
            yield "    <script src=\"";
            yield CoreExtension::getAttribute($this->env, $this->source, $context["script"], "href", [], "any", false, false, false, 27);
            yield "\" type=\"text/javascript\"></script>
  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['script'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 29
        yield "  ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["links"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["link"]) {
            // line 30
            yield "    <link href=\"";
            yield CoreExtension::getAttribute($this->env, $this->source, $context["link"], "href", [], "any", false, false, false, 30);
            yield "\" rel=\"";
            yield CoreExtension::getAttribute($this->env, $this->source, $context["link"], "rel", [], "any", false, false, false, 30);
            yield "\"/>
  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['link'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 32
        yield "  ";
        $context['_parent'] = $context;
        $context['_seq'] = CoreExtension::ensureTraversable(($context["analytics"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["analytic"]) {
            // line 33
            yield "    ";
            yield $context["analytic"];
            yield "
  ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_key'], $context['analytic'], $context['_parent']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 35
        yield "</head>
<body>
<div id=\"container\">
  <div id=\"alert\"></div>
  <nav id=\"top\">
    <div class=\"container\">
      <div class=\"row\">
        <div class=\"col-4\">
          <ul class=\"list-inline\">
            <li class=\"list-inline-item me-3\">";
        // line 44
        yield ($context["currency"] ?? null);
        yield "</li>
            <li class=\"list-inline-item\">";
        // line 45
        yield ($context["language"] ?? null);
        yield "</li>
          </ul>
        </div>
        <div class=\"col text-end\">
          <ul class=\"list-inline\">
            <li class=\"list-inline-item\"><a href=\"";
        // line 50
        yield ($context["contact"] ?? null);
        yield "\"><i class=\"fa-solid fa-phone\"></i> <span class=\"d-none d-lg-inline\">";
        yield ($context["telephone"] ?? null);
        yield "</span></a></li>
            <li class=\"list-inline-item\">
              <div class=\"dropdown\">
                <a href=\"#\" class=\"dropdown-toggle\" data-bs-toggle=\"dropdown\"><i class=\"fa-solid fa-user\"></i> <span class=\"d-none d-lg-inline\">";
        // line 53
        yield ($context["text_account"] ?? null);
        yield "</span> <i class=\"fa-solid fa-caret-down\"></i></a>
                <ul class=\"dropdown-menu dropdown-menu-right\">
                  ";
        // line 55
        if ( !($context["logged"] ?? null)) {
            // line 56
            yield "                    <li><a href=\"";
            yield ($context["register"] ?? null);
            yield "\" class=\"dropdown-item\">";
            yield ($context["text_register"] ?? null);
            yield "</a></li>
                    <li><a href=\"";
            // line 57
            yield ($context["login"] ?? null);
            yield "\" class=\"dropdown-item\">";
            yield ($context["text_login"] ?? null);
            yield "</a></li>
                  ";
        } else {
            // line 59
            yield "                    <li><a href=\"";
            yield ($context["account"] ?? null);
            yield "\" class=\"dropdown-item\">";
            yield ($context["text_account"] ?? null);
            yield "</a></li>
                    <li><a href=\"";
            // line 60
            yield ($context["order"] ?? null);
            yield "\" class=\"dropdown-item\">";
            yield ($context["text_order"] ?? null);
            yield "</a></li>
                    <li><a href=\"";
            // line 61
            yield ($context["transaction"] ?? null);
            yield "\" class=\"dropdown-item\">";
            yield ($context["text_transaction"] ?? null);
            yield "</a></li>
                    <li><a href=\"";
            // line 62
            yield ($context["download"] ?? null);
            yield "\" class=\"dropdown-item\">";
            yield ($context["text_download"] ?? null);
            yield "</a></li>
                    <li><a href=\"";
            // line 63
            yield ($context["logout"] ?? null);
            yield "\" class=\"dropdown-item\">";
            yield ($context["text_logout"] ?? null);
            yield "</a></li>
                  ";
        }
        // line 65
        yield "                </ul>
              </div>
            </li>
            <li class=\"list-inline-item\"><a href=\"";
        // line 68
        yield ($context["wishlist"] ?? null);
        yield "\" id=\"wishlist-total\" title=\"";
        yield ($context["text_wishlist"] ?? null);
        yield "\"><i class=\"fa-solid fa-heart\"></i> <span class=\"d-none d-lg-inline\">";
        yield ($context["text_wishlist"] ?? null);
        yield "</span></a></li>
            <li class=\"list-inline-item\"><a href=\"";
        // line 69
        yield ($context["shopping_cart"] ?? null);
        yield "\" title=\"";
        yield ($context["text_shopping_cart"] ?? null);
        yield "\"><i class=\"fa-solid fa-cart-shopping\"></i> <span class=\"d-none d-lg-inline\">";
        yield ($context["text_shopping_cart"] ?? null);
        yield "</span></a></li>
            <li class=\"list-inline-item\"><a href=\"";
        // line 70
        yield ($context["checkout"] ?? null);
        yield "\" title=\"";
        yield ($context["text_checkout"] ?? null);
        yield "\"><i class=\"fa-solid fa-share\"></i> <span class=\"d-none d-lg-inline\">";
        yield ($context["text_checkout"] ?? null);
        yield "</span></a></li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <header>
    <div class=\"container\">
      <div class=\"row\">
        <div class=\"col-md-3 col-lg-4\">
          <div id=\"logo\">
            ";
        // line 81
        if (($context["logo"] ?? null)) {
            // line 82
            yield "              <a href=\"";
            yield ($context["home"] ?? null);
            yield "\"><img src=\"";
            yield ($context["logo"] ?? null);
            yield "\" title=\"";
            yield ($context["name"] ?? null);
            yield "\" alt=\"";
            yield ($context["name"] ?? null);
            yield "\" class=\"img-fluid\"/></a>
            ";
        } else {
            // line 84
            yield "              <h1><a href=\"";
            yield ($context["home"] ?? null);
            yield "\">";
            yield ($context["name"] ?? null);
            yield "</a></h1>
            ";
        }
        // line 86
        yield "          </div>
        </div>
        <div class=\"col-md-5\">";
        // line 88
        yield ($context["search"] ?? null);
        yield "</div>
        <div id=\"cart\" class=\"col-md-4 col-lg-3 mb-2\">";
        // line 89
        yield ($context["cart"] ?? null);
        yield "</div>
      </div>
    </div>
  </header>
  <main>
    ";
        // line 94
        yield ($context["menu"] ?? null);
        yield "
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "catalog/view/template/common/header.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  329 => 94,  321 => 89,  317 => 88,  313 => 86,  305 => 84,  293 => 82,  291 => 81,  273 => 70,  265 => 69,  257 => 68,  252 => 65,  245 => 63,  239 => 62,  233 => 61,  227 => 60,  220 => 59,  213 => 57,  206 => 56,  204 => 55,  199 => 53,  191 => 50,  183 => 45,  179 => 44,  168 => 35,  159 => 33,  154 => 32,  143 => 30,  138 => 29,  129 => 27,  124 => 26,  111 => 24,  106 => 23,  100 => 21,  98 => 20,  93 => 18,  89 => 17,  85 => 16,  80 => 15,  74 => 13,  71 => 12,  65 => 10,  63 => 9,  59 => 8,  55 => 7,  45 => 2,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("<!DOCTYPE html>
<html dir=\"{{ direction }}\" lang=\"{{ lang }}\">
<head>
  <meta charset=\"UTF-8\"/>
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
  <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
  <title>{{ title }}</title>
  <base href=\"{{ base }}\"/>
  {% if description %}
    <meta name=\"description\" content=\"{{ description }}\"/>
  {% endif %}
  {% if keywords %}
    <meta name=\"keywords\" content=\"{{ keywords }}\"/>
  {% endif %}
  <script src=\"{{ jquery }}\" type=\"text/javascript\"></script>
  <link href=\"{{ bootstrap }}\" type=\"text/css\" rel=\"stylesheet\" media=\"screen\"/>
  <link href=\"{{ icons }}\" rel=\"stylesheet\" type=\"text/css\"/>
  <link href=\"{{ stylesheet }}\" type=\"text/css\" rel=\"stylesheet\"/>
  <script src=\"catalog/view/javascript/common.js\" type=\"text/javascript\"></script>
  {% if icon %}
    <link rel=\"icon\" href=\"{{ icon }}\" type=\"image/png\">
  {% endif %}
  {% for style in styles %}
    <link href=\"{{ style.href }}\" type=\"text/css\" rel=\"{{ style.rel }}\" media=\"{{ style.media }}\"/>
  {% endfor %}
  {% for script in scripts %}
    <script src=\"{{ script.href }}\" type=\"text/javascript\"></script>
  {% endfor %}
  {% for link in links %}
    <link href=\"{{ link.href }}\" rel=\"{{ link.rel }}\"/>
  {% endfor %}
  {% for analytic in analytics %}
    {{ analytic }}
  {% endfor %}
</head>
<body>
<div id=\"container\">
  <div id=\"alert\"></div>
  <nav id=\"top\">
    <div class=\"container\">
      <div class=\"row\">
        <div class=\"col-4\">
          <ul class=\"list-inline\">
            <li class=\"list-inline-item me-3\">{{ currency }}</li>
            <li class=\"list-inline-item\">{{ language }}</li>
          </ul>
        </div>
        <div class=\"col text-end\">
          <ul class=\"list-inline\">
            <li class=\"list-inline-item\"><a href=\"{{ contact }}\"><i class=\"fa-solid fa-phone\"></i> <span class=\"d-none d-lg-inline\">{{ telephone }}</span></a></li>
            <li class=\"list-inline-item\">
              <div class=\"dropdown\">
                <a href=\"#\" class=\"dropdown-toggle\" data-bs-toggle=\"dropdown\"><i class=\"fa-solid fa-user\"></i> <span class=\"d-none d-lg-inline\">{{ text_account }}</span> <i class=\"fa-solid fa-caret-down\"></i></a>
                <ul class=\"dropdown-menu dropdown-menu-right\">
                  {% if not logged %}
                    <li><a href=\"{{ register }}\" class=\"dropdown-item\">{{ text_register }}</a></li>
                    <li><a href=\"{{ login }}\" class=\"dropdown-item\">{{ text_login }}</a></li>
                  {% else %}
                    <li><a href=\"{{ account }}\" class=\"dropdown-item\">{{ text_account }}</a></li>
                    <li><a href=\"{{ order }}\" class=\"dropdown-item\">{{ text_order }}</a></li>
                    <li><a href=\"{{ transaction }}\" class=\"dropdown-item\">{{ text_transaction }}</a></li>
                    <li><a href=\"{{ download }}\" class=\"dropdown-item\">{{ text_download }}</a></li>
                    <li><a href=\"{{ logout }}\" class=\"dropdown-item\">{{ text_logout }}</a></li>
                  {% endif %}
                </ul>
              </div>
            </li>
            <li class=\"list-inline-item\"><a href=\"{{ wishlist }}\" id=\"wishlist-total\" title=\"{{ text_wishlist }}\"><i class=\"fa-solid fa-heart\"></i> <span class=\"d-none d-lg-inline\">{{ text_wishlist }}</span></a></li>
            <li class=\"list-inline-item\"><a href=\"{{ shopping_cart }}\" title=\"{{ text_shopping_cart }}\"><i class=\"fa-solid fa-cart-shopping\"></i> <span class=\"d-none d-lg-inline\">{{ text_shopping_cart }}</span></a></li>
            <li class=\"list-inline-item\"><a href=\"{{ checkout }}\" title=\"{{ text_checkout }}\"><i class=\"fa-solid fa-share\"></i> <span class=\"d-none d-lg-inline\">{{ text_checkout }}</span></a></li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <header>
    <div class=\"container\">
      <div class=\"row\">
        <div class=\"col-md-3 col-lg-4\">
          <div id=\"logo\">
            {% if logo %}
              <a href=\"{{ home }}\"><img src=\"{{ logo }}\" title=\"{{ name }}\" alt=\"{{ name }}\" class=\"img-fluid\"/></a>
            {% else %}
              <h1><a href=\"{{ home }}\">{{ name }}</a></h1>
            {% endif %}
          </div>
        </div>
        <div class=\"col-md-5\">{{ search }}</div>
        <div id=\"cart\" class=\"col-md-4 col-lg-3 mb-2\">{{ cart }}</div>
      </div>
    </div>
  </header>
  <main>
    {{ menu }}
", "catalog/view/template/common/header.twig", "C:\\laragon\\www\\candyfandy\\catalog\\view\\template\\common\\header.twig");
    }
}
