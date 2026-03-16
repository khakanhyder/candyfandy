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

/* install/view/template/install/step_2.twig */
class __TwigTemplate_83e45fd384062371ee4346c976edf865 extends Template
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
        yield ($context["header"] ?? null);
        yield "
<div id=\"content\">
  <div class=\"page-header\">
    <div class=\"container\">
      <h1>";
        // line 5
        yield ($context["heading_title"] ?? null);
        yield "</h1>
    </div>
  </div>
  <div class=\"container\">
    <div class=\"card\">
      <div class=\"card-header\"><i class=\"fa-solid fa-pencil\"></i> ";
        // line 10
        yield ($context["text_step_2"] ?? null);
        yield "</div>
      <div class=\"card-body\">
        <form id=\"form-step-2\">
          <fieldset>
            <legend>";
        // line 14
        yield ($context["text_install_php"] ?? null);
        yield "</legend>
            <table class=\"table table-bordered\">
              <thead>
                <tr>
                  <td class=\"w-25\"><b>";
        // line 18
        yield ($context["text_setting"] ?? null);
        yield "</b></td>
                  <td class=\"w-25\"><b>";
        // line 19
        yield ($context["text_current"] ?? null);
        yield "</b></td>
                  <td class=\"w-25\"><b>";
        // line 20
        yield ($context["text_required"] ?? null);
        yield "</b></td>
                  <td class=\"w-25 text-center\"><b>";
        // line 21
        yield ($context["text_status"] ?? null);
        yield "</b></td>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>";
        // line 26
        yield ($context["text_version"] ?? null);
        yield "</td>
                  <td>";
        // line 27
        yield ($context["php_version"] ?? null);
        yield "</td>
                  <td>8.0+</td>
                  <td class=\"text-center\">
                    ";
        // line 30
        if (($context["version"] ?? null)) {
            // line 31
            yield "                      <span class=\"text-success\"><i class=\"fa-solid fa-check\"></i></span>
                    ";
        } else {
            // line 33
            yield "                      <span class=\"text-danger\"><i class=\"fa-solid fa-circle-xmark\"></i></span>
                    ";
        }
        // line 34
        yield "</td>
                </tr>
                <tr";
        // line 36
        if (($context["open_basedir"] ?? null)) {
            yield " class=\"table-danger\"";
        }
        yield ">
                  <td>";
        // line 37
        yield ($context["text_open_basedir"] ?? null);
        yield "</td>
                  <td>";
        // line 38
        if ( !($context["open_basedir"] ?? null)) {
            // line 39
            yield "                    <span class=\"text-success\">";
            yield ($context["open_basedir_current"] ?? null);
            yield "</span>
                  ";
        } else {
            // line 41
            yield "                    <span class=\"text-danger\"> ";
            yield ($context["open_basedir_current"] ?? null);
            yield "</span>
                    ";
        }
        // line 42
        yield "</td>
                  <td>";
        // line 43
        yield ($context["open_basedir_required"] ?? null);
        yield "</td>
                  <td class=\"text-center\">";
        // line 44
        if ( !($context["open_basedir"] ?? null)) {
            // line 45
            yield "                      <span class=\"text-success\"><i class=\"fa-solid fa-check\"></i></span>
                    ";
        } else {
            // line 47
            yield "                      <span class=\"text-danger\"><i class=\"fa-solid fa-circle-xmark\"></i></span>
                    ";
        }
        // line 48
        yield "</td>
                </tr>
                <tr";
        // line 50
        if (($context["magic_quotes_gpc"] ?? null)) {
            yield " class=\"table-danger\"";
        }
        yield ">
                  <td>";
        // line 51
        yield ($context["text_magic"] ?? null);
        yield "</td>
                  <td>";
        // line 52
        if (($context["magic_quotes_gpc"] ?? null)) {
            // line 53
            yield "                      ";
            yield ($context["text_on"] ?? null);
            yield "
                    ";
        } else {
            // line 55
            yield "                      ";
            yield ($context["text_off"] ?? null);
            yield "
                    ";
        }
        // line 56
        yield "</td>
                  <td>";
        // line 57
        yield ($context["text_off"] ?? null);
        yield "</td>
                  <td class=\"text-center\">
                    ";
        // line 59
        if ( !($context["error_magic_quotes_gpc"] ?? null)) {
            // line 60
            yield "                      <span class=\"text-success\"><i class=\"fa-solid fa-check\"></i></span>
                    ";
        } else {
            // line 62
            yield "                      <span class=\"text-danger\"><i class=\"fa-solid fa-circle-xmark\"></i></span>
                    ";
        }
        // line 63
        yield "</td>
                </tr>
                <tr";
        // line 65
        if (($context["register_globals"] ?? null)) {
            yield " class=\"table-danger\"";
        }
        yield ">
                  <td>";
        // line 66
        yield ($context["text_global"] ?? null);
        yield "</td>
                  <td>";
        // line 67
        if (($context["register_globals"] ?? null)) {
            // line 68
            yield "                      ";
            yield ($context["text_on"] ?? null);
            yield "
                    ";
        } else {
            // line 70
            yield "                      ";
            yield ($context["text_off"] ?? null);
            yield "
                    ";
        }
        // line 71
        yield "</td>
                  <td>";
        // line 72
        yield ($context["text_off"] ?? null);
        yield "</td>
                  <td class=\"text-center\">
                    ";
        // line 74
        if ( !($context["register_globals"] ?? null)) {
            // line 75
            yield "                      <span class=\"text-success\"><i class=\"fa-solid fa-check\"></i></span>
                    ";
        } else {
            // line 77
            yield "                      <span class=\"text-danger\"><i class=\"fa-solid fa-circle-xmark\"></i></span>
                    ";
        }
        // line 78
        yield "</td>
                </tr>
                <tr";
        // line 80
        if ( !($context["file_uploads"] ?? null)) {
            yield " class=\"table-danger\"";
        }
        yield ">
                  <td>";
        // line 81
        yield ($context["text_file_upload"] ?? null);
        yield "</td>
                  <td>";
        // line 82
        if (($context["file_uploads"] ?? null)) {
            // line 83
            yield "                      ";
            yield ($context["text_on"] ?? null);
            yield "
                    ";
        } else {
            // line 85
            yield "                      ";
            yield ($context["text_off"] ?? null);
            yield "
                    ";
        }
        // line 86
        yield "</td>
                  <td>";
        // line 87
        yield ($context["text_on"] ?? null);
        yield "</td>
                  <td class=\"text-center\">";
        // line 88
        if (($context["file_uploads"] ?? null)) {
            // line 89
            yield "                      <span class=\"text-success\"><i class=\"fa-solid fa-check\"></i></span>
                    ";
        } else {
            // line 91
            yield "                      <span class=\"text-danger\"><i class=\"fa-solid fa-circle-xmark\"></i></span>
                    ";
        }
        // line 92
        yield "</td>
                </tr>
                <tr";
        // line 94
        if (($context["session_auto_start"] ?? null)) {
            yield " class=\"table-danger\"";
        }
        yield ">
                  <td>";
        // line 95
        yield ($context["text_session"] ?? null);
        yield "</td>
                  <td>";
        // line 96
        if (($context["session_auto_start"] ?? null)) {
            // line 97
            yield "                      ";
            yield ($context["text_on"] ?? null);
            yield "
                    ";
        } else {
            // line 99
            yield "                      ";
            yield ($context["text_off"] ?? null);
            yield "
                    ";
        }
        // line 100
        yield "</td>
                  <td>";
        // line 101
        yield ($context["text_off"] ?? null);
        yield "</td>
                  <td class=\"text-center\">";
        // line 102
        if ( !($context["session_auto_start"] ?? null)) {
            // line 103
            yield "                      <span class=\"text-success\"><i class=\"fa-solid fa-check\"></i></span>
                    ";
        } else {
            // line 105
            yield "                      <span class=\"text-danger\"><i class=\"fa-solid fa-circle-xmark\"></i></span>
                    ";
        }
        // line 106
        yield "</td>
                </tr>
              </tbody>
            </table>
          </fieldset>
          <fieldset>
            <legend>";
        // line 112
        yield ($context["text_install_extension"] ?? null);
        yield "</legend>
            <table class=\"table table-bordered\">
              <thead>
                <tr>
                  <td class=\"w-25\"><b>";
        // line 116
        yield ($context["text_extension"] ?? null);
        yield "</b></td>
                  <td class=\"w-25\"><b>";
        // line 117
        yield ($context["text_current"] ?? null);
        yield "</b></td>
                  <td class=\"w-25\"><b>";
        // line 118
        yield ($context["text_required"] ?? null);
        yield "</b></td>
                  <td class=\"w-25 text-center\"><b>";
        // line 119
        yield ($context["text_status"] ?? null);
        yield "</b></td>
                </tr>
              </thead>
              <tbody>
                <tr";
        // line 123
        if ( !($context["db"] ?? null)) {
            yield " class=\"table-danger\"";
        }
        yield ">
                  <td>";
        // line 124
        yield ($context["text_db"] ?? null);
        yield "</td>
                  <td>";
        // line 125
        if (($context["db"] ?? null)) {
            // line 126
            yield "                      ";
            yield ($context["text_on"] ?? null);
            yield "
                    ";
        } else {
            // line 128
            yield "                      ";
            yield ($context["text_off"] ?? null);
            yield "
                    ";
        }
        // line 129
        yield "</td>
                  <td>";
        // line 130
        yield ($context["text_on"] ?? null);
        yield "</td>
                  <td class=\"text-center\">";
        // line 131
        if (($context["db"] ?? null)) {
            // line 132
            yield "                      <span class=\"text-success\"><i class=\"fa-solid fa-check\"></i></span>
                    ";
        } else {
            // line 134
            yield "                      <span class=\"text-danger\"><i class=\"fa-solid fa-circle-xmark\"></i></span>
                    ";
        }
        // line 135
        yield "</td>
                </tr>
                <tr";
        // line 137
        if ( !($context["gd"] ?? null)) {
            yield " class=\"table-danger\"";
        }
        yield ">
                  <td>";
        // line 138
        yield ($context["text_gd"] ?? null);
        yield "</td>
                  <td>";
        // line 139
        if (($context["gd"] ?? null)) {
            // line 140
            yield "                      ";
            yield ($context["text_on"] ?? null);
            yield "
                    ";
        } else {
            // line 142
            yield "                      ";
            yield ($context["text_off"] ?? null);
            yield "
                    ";
        }
        // line 143
        yield "</td>
                  <td>";
        // line 144
        yield ($context["text_on"] ?? null);
        yield "</td>
                  <td class=\"text-center\">";
        // line 145
        if (($context["gd"] ?? null)) {
            // line 146
            yield "                      <span class=\"text-success\"><i class=\"fa-solid fa-check\"></i></span>
                    ";
        } else {
            // line 148
            yield "                      <span class=\"text-danger\"><i class=\"fa-solid fa-circle-xmark\"></i></span>
                    ";
        }
        // line 149
        yield "</td>
                </tr>
                <tr";
        // line 151
        if ( !($context["curl"] ?? null)) {
            yield " class=\"table-danger\"";
        }
        yield ">
                  <td>";
        // line 152
        yield ($context["text_curl"] ?? null);
        yield "</td>
                  <td>";
        // line 153
        if (($context["curl"] ?? null)) {
            // line 154
            yield "                      ";
            yield ($context["text_on"] ?? null);
            yield "
                    ";
        } else {
            // line 156
            yield "                      ";
            yield ($context["text_off"] ?? null);
            yield "
                    ";
        }
        // line 157
        yield "</td>
                  <td>";
        // line 158
        yield ($context["text_on"] ?? null);
        yield "</td>
                  <td class=\"text-center\">";
        // line 159
        if (($context["curl"] ?? null)) {
            // line 160
            yield "                      <span class=\"text-success\"><i class=\"fa-solid fa-check\"></i></span>
                    ";
        } else {
            // line 162
            yield "                      <span class=\"text-danger\"><i class=\"fa-solid fa-circle-xmark\"></i></span>
                    ";
        }
        // line 163
        yield "</td>
                </tr>
                <tr";
        // line 165
        if ( !($context["openssl"] ?? null)) {
            yield " class=\"table-danger\"";
        }
        yield ">
                  <td>";
        // line 166
        yield ($context["text_openssl"] ?? null);
        yield "</td>
                  <td>";
        // line 167
        if (($context["openssl"] ?? null)) {
            // line 168
            yield "                      ";
            yield ($context["text_on"] ?? null);
            yield "
                    ";
        } else {
            // line 170
            yield "                      ";
            yield ($context["text_off"] ?? null);
            yield "
                    ";
        }
        // line 171
        yield "</td>
                  <td>";
        // line 172
        yield ($context["text_on"] ?? null);
        yield "</td>
                  <td class=\"text-center\">";
        // line 173
        if (($context["openssl"] ?? null)) {
            // line 174
            yield "                      <span class=\"text-success\"><i class=\"fa-solid fa-check\"></i></span>
                    ";
        } else {
            // line 176
            yield "                      <span class=\"text-danger\"><i class=\"fa-solid fa-circle-xmark\"></i></span>
                    ";
        }
        // line 177
        yield "</td>
                </tr>
                <tr";
        // line 179
        if ( !($context["zlib"] ?? null)) {
            yield " class=\"table-danger\"";
        }
        yield ">
                  <td>";
        // line 180
        yield ($context["text_zlib"] ?? null);
        yield "</td>
                  <td>";
        // line 181
        if (($context["zlib"] ?? null)) {
            // line 182
            yield "                      ";
            yield ($context["text_on"] ?? null);
            yield "
                    ";
        } else {
            // line 184
            yield "                      ";
            yield ($context["text_off"] ?? null);
            yield "
                    ";
        }
        // line 185
        yield "</td>
                  <td>";
        // line 186
        yield ($context["text_on"] ?? null);
        yield "</td>
                  <td class=\"text-center\">";
        // line 187
        if (($context["zlib"] ?? null)) {
            // line 188
            yield "                      <span class=\"text-success\"><i class=\"fa-solid fa-check\"></i></span>
                    ";
        } else {
            // line 190
            yield "                      <span class=\"text-danger\"><i class=\"fa-solid fa-circle-xmark\"></i></span>
                    ";
        }
        // line 191
        yield "</td>
                </tr>
                <tr";
        // line 193
        if ( !($context["zip"] ?? null)) {
            yield " class=\"table-danger\"";
        }
        yield ">
                  <td>";
        // line 194
        yield ($context["text_zip"] ?? null);
        yield "</td>
                  <td>";
        // line 195
        if (($context["zip"] ?? null)) {
            // line 196
            yield "                      ";
            yield ($context["text_on"] ?? null);
            yield "
                    ";
        } else {
            // line 198
            yield "                      ";
            yield ($context["text_off"] ?? null);
            yield "
                    ";
        }
        // line 199
        yield "</td>
                  <td>";
        // line 200
        yield ($context["text_on"] ?? null);
        yield "</td>
                  <td class=\"text-center\">";
        // line 201
        if (($context["zip"] ?? null)) {
            // line 202
            yield "                      <span class=\"text-success\"><i class=\"fa-solid fa-check\"></i></span>
                    ";
        } else {
            // line 204
            yield "                      <span class=\"text-danger\"><i class=\"fa-solid fa-circle-xmark\"></i></span>
                    ";
        }
        // line 205
        yield "</td>
                </tr>
                ";
        // line 207
        if ( !($context["iconv"] ?? null)) {
            // line 208
            yield "                  <tr";
            if ( !($context["mbstring"] ?? null)) {
                yield " class=\"table-danger\"";
            }
            yield ">
                    <td>";
            // line 209
            yield ($context["text_mbstring"] ?? null);
            yield "</td>
                    <td>";
            // line 210
            if (($context["mbstring"] ?? null)) {
                // line 211
                yield "                        ";
                yield ($context["text_on"] ?? null);
                yield "
                      ";
            } else {
                // line 213
                yield "                        ";
                yield ($context["text_off"] ?? null);
                yield "
                      ";
            }
            // line 214
            yield "</td>
                    <td>";
            // line 215
            yield ($context["text_on"] ?? null);
            yield "</td>
                    <td class=\"text-center\">";
            // line 216
            if (($context["mbstring"] ?? null)) {
                // line 217
                yield "                        <span class=\"text-success\"><i class=\"fa-solid fa-check\"></i></span>
                      ";
            } else {
                // line 219
                yield "                        <span class=\"text-danger\"><i class=\"fa-solid fa-circle-xmark\"></i></span>
                      ";
            }
            // line 220
            yield "</td>
                  </tr>
                ";
        }
        // line 223
        yield "              </tbody>
            </table>
          </fieldset>
          <fieldset>
            <legend>";
        // line 227
        yield ($context["text_install_file"] ?? null);
        yield "</legend>
            <table class=\"table table-bordered\">
              <thead>
                <tr>
                  <td><b>";
        // line 231
        yield ($context["text_file"] ?? null);
        yield "</b></td>
                  <td><b>";
        // line 232
        yield ($context["text_status"] ?? null);
        yield "</b></td>
                </tr>
              </thead>
              <tbody>
                <tr";
        // line 236
        if (($context["error_catalog_config"] ?? null)) {
            yield " class=\"table-danger\"";
        }
        yield ">
                  <td>";
        // line 237
        yield ($context["catalog_config"] ?? null);
        yield "</td>
                  <td>";
        // line 238
        if ( !($context["error_catalog_config"] ?? null)) {
            // line 239
            yield "                      <span class=\"text-success\">";
            yield ($context["text_writable"] ?? null);
            yield "</span>
                    ";
        } else {
            // line 241
            yield "                      <span class=\"text-danger\">";
            yield ($context["error_catalog_config"] ?? null);
            yield "</span>
                    ";
        }
        // line 242
        yield "</td>
                </tr>
                <tr";
        // line 244
        if (($context["error_admin_config"] ?? null)) {
            yield " class=\"table-danger\"";
        }
        yield ">
                  <td>";
        // line 245
        yield ($context["admin_config"] ?? null);
        yield "</td>
                  <td>";
        // line 246
        if ( !($context["error_admin_config"] ?? null)) {
            // line 247
            yield "                      <span class=\"text-success\">";
            yield ($context["text_writable"] ?? null);
            yield "</span>
                    ";
        } else {
            // line 249
            yield "                      <span class=\"text-danger\">";
            yield ($context["error_admin_config"] ?? null);
            yield "</span>
                    ";
        }
        // line 250
        yield "</td>
                </tr>
              </tbody>
            </table>
          </fieldset>
          <div class=\"row mt-3\">
            <div class=\"col\"><a href=\"";
        // line 256
        yield ($context["back"] ?? null);
        yield "\" class=\"btn btn-light\">";
        yield ($context["button_back"] ?? null);
        yield "</a></div>
            <div class=\"col text-end\"><button type=\"submit\" id=\"button-continue\" class=\"btn btn-primary\">";
        // line 257
        yield ($context["button_continue"] ?? null);
        yield "</button></div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script type=\"text/javascript\"><!--
\$('#form-step-2').on('submit', function(e) {
    e.preventDefault();

    \$.ajax({
        url: 'index.php?route=install/step_2.save&language=";
        // line 269
        yield ($context["language"] ?? null);
        yield "',
        type: 'post',
        data: \$('#form-step-2').serialize(),
        dataType: 'json',
        beforeSend: function() {
            \$('#button-continue').prop('disabled', true);
        },
        complete: function() {
            \$('#button-continue').prop('disabled', false);
        },
        success: function(json) {
            console.log(json);

            \$('.alert-dismissible').remove();

            if (json['redirect']) {
                location = json['redirect'];
            }

            if (json['error']) {
                \$('#form-step-2').prepend('<div class=\"alert alert-danger alert-dismissible\"><i class=\"fa-solid fa-circle-exclamation\"></i> ' + json['error'] + ' <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\"></button></div>');
            }
        },
        error: function(xhr, ajaxOptions, thrownError) {
            console.log(thrownError + \"\\r\\n\" + xhr.statusText + \"\\r\\n\" + xhr.responseText);
        }
    });
});
//--></script>
";
        // line 298
        yield ($context["footer"] ?? null);
        yield "
";
        yield from [];
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "install/view/template/install/step_2.twig";
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
        return array (  828 => 298,  796 => 269,  781 => 257,  775 => 256,  767 => 250,  761 => 249,  755 => 247,  753 => 246,  749 => 245,  743 => 244,  739 => 242,  733 => 241,  727 => 239,  725 => 238,  721 => 237,  715 => 236,  708 => 232,  704 => 231,  697 => 227,  691 => 223,  686 => 220,  682 => 219,  678 => 217,  676 => 216,  672 => 215,  669 => 214,  663 => 213,  657 => 211,  655 => 210,  651 => 209,  644 => 208,  642 => 207,  638 => 205,  634 => 204,  630 => 202,  628 => 201,  624 => 200,  621 => 199,  615 => 198,  609 => 196,  607 => 195,  603 => 194,  597 => 193,  593 => 191,  589 => 190,  585 => 188,  583 => 187,  579 => 186,  576 => 185,  570 => 184,  564 => 182,  562 => 181,  558 => 180,  552 => 179,  548 => 177,  544 => 176,  540 => 174,  538 => 173,  534 => 172,  531 => 171,  525 => 170,  519 => 168,  517 => 167,  513 => 166,  507 => 165,  503 => 163,  499 => 162,  495 => 160,  493 => 159,  489 => 158,  486 => 157,  480 => 156,  474 => 154,  472 => 153,  468 => 152,  462 => 151,  458 => 149,  454 => 148,  450 => 146,  448 => 145,  444 => 144,  441 => 143,  435 => 142,  429 => 140,  427 => 139,  423 => 138,  417 => 137,  413 => 135,  409 => 134,  405 => 132,  403 => 131,  399 => 130,  396 => 129,  390 => 128,  384 => 126,  382 => 125,  378 => 124,  372 => 123,  365 => 119,  361 => 118,  357 => 117,  353 => 116,  346 => 112,  338 => 106,  334 => 105,  330 => 103,  328 => 102,  324 => 101,  321 => 100,  315 => 99,  309 => 97,  307 => 96,  303 => 95,  297 => 94,  293 => 92,  289 => 91,  285 => 89,  283 => 88,  279 => 87,  276 => 86,  270 => 85,  264 => 83,  262 => 82,  258 => 81,  252 => 80,  248 => 78,  244 => 77,  240 => 75,  238 => 74,  233 => 72,  230 => 71,  224 => 70,  218 => 68,  216 => 67,  212 => 66,  206 => 65,  202 => 63,  198 => 62,  194 => 60,  192 => 59,  187 => 57,  184 => 56,  178 => 55,  172 => 53,  170 => 52,  166 => 51,  160 => 50,  156 => 48,  152 => 47,  148 => 45,  146 => 44,  142 => 43,  139 => 42,  133 => 41,  127 => 39,  125 => 38,  121 => 37,  115 => 36,  111 => 34,  107 => 33,  103 => 31,  101 => 30,  95 => 27,  91 => 26,  83 => 21,  79 => 20,  75 => 19,  71 => 18,  64 => 14,  57 => 10,  49 => 5,  42 => 1,);
    }

    public function getSourceContext(): Source
    {
        return new Source("{{ header }}
<div id=\"content\">
  <div class=\"page-header\">
    <div class=\"container\">
      <h1>{{ heading_title }}</h1>
    </div>
  </div>
  <div class=\"container\">
    <div class=\"card\">
      <div class=\"card-header\"><i class=\"fa-solid fa-pencil\"></i> {{ text_step_2 }}</div>
      <div class=\"card-body\">
        <form id=\"form-step-2\">
          <fieldset>
            <legend>{{ text_install_php }}</legend>
            <table class=\"table table-bordered\">
              <thead>
                <tr>
                  <td class=\"w-25\"><b>{{ text_setting }}</b></td>
                  <td class=\"w-25\"><b>{{ text_current }}</b></td>
                  <td class=\"w-25\"><b>{{ text_required }}</b></td>
                  <td class=\"w-25 text-center\"><b>{{ text_status }}</b></td>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>{{ text_version }}</td>
                  <td>{{ php_version }}</td>
                  <td>8.0+</td>
                  <td class=\"text-center\">
                    {% if version %}
                      <span class=\"text-success\"><i class=\"fa-solid fa-check\"></i></span>
                    {% else %}
                      <span class=\"text-danger\"><i class=\"fa-solid fa-circle-xmark\"></i></span>
                    {% endif %}</td>
                </tr>
                <tr{% if open_basedir %} class=\"table-danger\"{% endif %}>
                  <td>{{ text_open_basedir }}</td>
                  <td>{% if not open_basedir %}
                    <span class=\"text-success\">{{ open_basedir_current }}</span>
                  {% else %}
                    <span class=\"text-danger\"> {{ open_basedir_current }}</span>
                    {% endif %}</td>
                  <td>{{ open_basedir_required }}</td>
                  <td class=\"text-center\">{% if not open_basedir %}
                      <span class=\"text-success\"><i class=\"fa-solid fa-check\"></i></span>
                    {% else %}
                      <span class=\"text-danger\"><i class=\"fa-solid fa-circle-xmark\"></i></span>
                    {% endif %}</td>
                </tr>
                <tr{% if magic_quotes_gpc %} class=\"table-danger\"{% endif %}>
                  <td>{{ text_magic }}</td>
                  <td>{% if magic_quotes_gpc %}
                      {{ text_on }}
                    {% else %}
                      {{ text_off }}
                    {% endif %}</td>
                  <td>{{ text_off }}</td>
                  <td class=\"text-center\">
                    {% if not error_magic_quotes_gpc %}
                      <span class=\"text-success\"><i class=\"fa-solid fa-check\"></i></span>
                    {% else %}
                      <span class=\"text-danger\"><i class=\"fa-solid fa-circle-xmark\"></i></span>
                    {% endif %}</td>
                </tr>
                <tr{% if register_globals %} class=\"table-danger\"{% endif %}>
                  <td>{{ text_global }}</td>
                  <td>{% if register_globals %}
                      {{ text_on }}
                    {% else %}
                      {{ text_off }}
                    {% endif %}</td>
                  <td>{{ text_off }}</td>
                  <td class=\"text-center\">
                    {% if not register_globals %}
                      <span class=\"text-success\"><i class=\"fa-solid fa-check\"></i></span>
                    {% else %}
                      <span class=\"text-danger\"><i class=\"fa-solid fa-circle-xmark\"></i></span>
                    {% endif %}</td>
                </tr>
                <tr{% if not file_uploads %} class=\"table-danger\"{% endif %}>
                  <td>{{ text_file_upload }}</td>
                  <td>{% if file_uploads %}
                      {{ text_on }}
                    {% else %}
                      {{ text_off }}
                    {% endif %}</td>
                  <td>{{ text_on }}</td>
                  <td class=\"text-center\">{% if file_uploads %}
                      <span class=\"text-success\"><i class=\"fa-solid fa-check\"></i></span>
                    {% else %}
                      <span class=\"text-danger\"><i class=\"fa-solid fa-circle-xmark\"></i></span>
                    {% endif %}</td>
                </tr>
                <tr{% if session_auto_start %} class=\"table-danger\"{% endif %}>
                  <td>{{ text_session }}</td>
                  <td>{% if session_auto_start %}
                      {{ text_on }}
                    {% else %}
                      {{ text_off }}
                    {% endif %}</td>
                  <td>{{ text_off }}</td>
                  <td class=\"text-center\">{% if not session_auto_start %}
                      <span class=\"text-success\"><i class=\"fa-solid fa-check\"></i></span>
                    {% else %}
                      <span class=\"text-danger\"><i class=\"fa-solid fa-circle-xmark\"></i></span>
                    {% endif %}</td>
                </tr>
              </tbody>
            </table>
          </fieldset>
          <fieldset>
            <legend>{{ text_install_extension }}</legend>
            <table class=\"table table-bordered\">
              <thead>
                <tr>
                  <td class=\"w-25\"><b>{{ text_extension }}</b></td>
                  <td class=\"w-25\"><b>{{ text_current }}</b></td>
                  <td class=\"w-25\"><b>{{ text_required }}</b></td>
                  <td class=\"w-25 text-center\"><b>{{ text_status }}</b></td>
                </tr>
              </thead>
              <tbody>
                <tr{% if not db %} class=\"table-danger\"{% endif %}>
                  <td>{{ text_db }}</td>
                  <td>{% if db %}
                      {{ text_on }}
                    {% else %}
                      {{ text_off }}
                    {% endif %}</td>
                  <td>{{ text_on }}</td>
                  <td class=\"text-center\">{% if db %}
                      <span class=\"text-success\"><i class=\"fa-solid fa-check\"></i></span>
                    {% else %}
                      <span class=\"text-danger\"><i class=\"fa-solid fa-circle-xmark\"></i></span>
                    {% endif %}</td>
                </tr>
                <tr{% if not gd %} class=\"table-danger\"{% endif %}>
                  <td>{{ text_gd }}</td>
                  <td>{% if gd %}
                      {{ text_on }}
                    {% else %}
                      {{ text_off }}
                    {% endif %}</td>
                  <td>{{ text_on }}</td>
                  <td class=\"text-center\">{% if gd %}
                      <span class=\"text-success\"><i class=\"fa-solid fa-check\"></i></span>
                    {% else %}
                      <span class=\"text-danger\"><i class=\"fa-solid fa-circle-xmark\"></i></span>
                    {% endif %}</td>
                </tr>
                <tr{% if not curl %} class=\"table-danger\"{% endif %}>
                  <td>{{ text_curl }}</td>
                  <td>{% if curl %}
                      {{ text_on }}
                    {% else %}
                      {{ text_off }}
                    {% endif %}</td>
                  <td>{{ text_on }}</td>
                  <td class=\"text-center\">{% if curl %}
                      <span class=\"text-success\"><i class=\"fa-solid fa-check\"></i></span>
                    {% else %}
                      <span class=\"text-danger\"><i class=\"fa-solid fa-circle-xmark\"></i></span>
                    {% endif %}</td>
                </tr>
                <tr{% if not openssl %} class=\"table-danger\"{% endif %}>
                  <td>{{ text_openssl }}</td>
                  <td>{% if openssl %}
                      {{ text_on }}
                    {% else %}
                      {{ text_off }}
                    {% endif %}</td>
                  <td>{{ text_on }}</td>
                  <td class=\"text-center\">{% if openssl %}
                      <span class=\"text-success\"><i class=\"fa-solid fa-check\"></i></span>
                    {% else %}
                      <span class=\"text-danger\"><i class=\"fa-solid fa-circle-xmark\"></i></span>
                    {% endif %}</td>
                </tr>
                <tr{% if not zlib %} class=\"table-danger\"{% endif %}>
                  <td>{{ text_zlib }}</td>
                  <td>{% if zlib %}
                      {{ text_on }}
                    {% else %}
                      {{ text_off }}
                    {% endif %}</td>
                  <td>{{ text_on }}</td>
                  <td class=\"text-center\">{% if zlib %}
                      <span class=\"text-success\"><i class=\"fa-solid fa-check\"></i></span>
                    {% else %}
                      <span class=\"text-danger\"><i class=\"fa-solid fa-circle-xmark\"></i></span>
                    {% endif %}</td>
                </tr>
                <tr{% if not zip %} class=\"table-danger\"{% endif %}>
                  <td>{{ text_zip }}</td>
                  <td>{% if zip %}
                      {{ text_on }}
                    {% else %}
                      {{ text_off }}
                    {% endif %}</td>
                  <td>{{ text_on }}</td>
                  <td class=\"text-center\">{% if zip %}
                      <span class=\"text-success\"><i class=\"fa-solid fa-check\"></i></span>
                    {% else %}
                      <span class=\"text-danger\"><i class=\"fa-solid fa-circle-xmark\"></i></span>
                    {% endif %}</td>
                </tr>
                {% if not iconv %}
                  <tr{% if not mbstring %} class=\"table-danger\"{% endif %}>
                    <td>{{ text_mbstring }}</td>
                    <td>{% if mbstring %}
                        {{ text_on }}
                      {% else %}
                        {{ text_off }}
                      {% endif %}</td>
                    <td>{{ text_on }}</td>
                    <td class=\"text-center\">{% if mbstring %}
                        <span class=\"text-success\"><i class=\"fa-solid fa-check\"></i></span>
                      {% else %}
                        <span class=\"text-danger\"><i class=\"fa-solid fa-circle-xmark\"></i></span>
                      {% endif %}</td>
                  </tr>
                {% endif %}
              </tbody>
            </table>
          </fieldset>
          <fieldset>
            <legend>{{ text_install_file }}</legend>
            <table class=\"table table-bordered\">
              <thead>
                <tr>
                  <td><b>{{ text_file }}</b></td>
                  <td><b>{{ text_status }}</b></td>
                </tr>
              </thead>
              <tbody>
                <tr{% if error_catalog_config %} class=\"table-danger\"{% endif %}>
                  <td>{{ catalog_config }}</td>
                  <td>{% if not error_catalog_config %}
                      <span class=\"text-success\">{{ text_writable }}</span>
                    {% else %}
                      <span class=\"text-danger\">{{ error_catalog_config }}</span>
                    {% endif %}</td>
                </tr>
                <tr{% if error_admin_config %} class=\"table-danger\"{% endif %}>
                  <td>{{ admin_config }}</td>
                  <td>{% if not error_admin_config %}
                      <span class=\"text-success\">{{ text_writable }}</span>
                    {% else %}
                      <span class=\"text-danger\">{{ error_admin_config }}</span>
                    {% endif %}</td>
                </tr>
              </tbody>
            </table>
          </fieldset>
          <div class=\"row mt-3\">
            <div class=\"col\"><a href=\"{{ back }}\" class=\"btn btn-light\">{{ button_back }}</a></div>
            <div class=\"col text-end\"><button type=\"submit\" id=\"button-continue\" class=\"btn btn-primary\">{{ button_continue }}</button></div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script type=\"text/javascript\"><!--
\$('#form-step-2').on('submit', function(e) {
    e.preventDefault();

    \$.ajax({
        url: 'index.php?route=install/step_2.save&language={{ language }}',
        type: 'post',
        data: \$('#form-step-2').serialize(),
        dataType: 'json',
        beforeSend: function() {
            \$('#button-continue').prop('disabled', true);
        },
        complete: function() {
            \$('#button-continue').prop('disabled', false);
        },
        success: function(json) {
            console.log(json);

            \$('.alert-dismissible').remove();

            if (json['redirect']) {
                location = json['redirect'];
            }

            if (json['error']) {
                \$('#form-step-2').prepend('<div class=\"alert alert-danger alert-dismissible\"><i class=\"fa-solid fa-circle-exclamation\"></i> ' + json['error'] + ' <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\"></button></div>');
            }
        },
        error: function(xhr, ajaxOptions, thrownError) {
            console.log(thrownError + \"\\r\\n\" + xhr.statusText + \"\\r\\n\" + xhr.responseText);
        }
    });
});
//--></script>
{{ footer }}
", "install/view/template/install/step_2.twig", "C:\\laragon\\www\\candyfandy\\install\\view\\template\\install\\step_2.twig");
    }
}
