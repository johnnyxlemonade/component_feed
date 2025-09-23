<?php declare(strict_types=1);

namespace Lemonade\Feed\Infrastructure\Xsl;

final class SitemapXslTemplate
{
    public static function render(array $t): string
    {
        return strtr(self::content(), [
            '{{title}}'         => $t['title'],
            '{{breadcrumb}}'    => $t['breadcrumb'],
            '{{heading}}'       => $t['heading'],
            '{{generated}}'     => $t['generated'],
            '{{dt_search}}'     => $t['datatable']['search'],
            '{{dt_lengthMenu}}' => $t['datatable']['lengthMenu'],
            '{{dt_info}}'       => $t['datatable']['info'],
            '{{dt_infoFiltered}}'=> $t['datatable']['infoFiltered'],
            '{{dt_infoEmpty}}'  => $t['datatable']['infoEmpty'],
            '{{dt_zeroRecords}}'=> $t['datatable']['zeroRecords'],
            '{{dt_first}}'      => $t['datatable']['paginate']['first'],
            '{{dt_last}}'       => $t['datatable']['paginate']['last'],
            '{{dt_next}}'       => $t['datatable']['paginate']['next'],
            '{{dt_previous}}'   => $t['datatable']['paginate']['previous'],
            '{{col_url}}'       => $t['columns']['url'],
            '{{col_priority}}'  => $t['columns']['priority'],
            '{{col_frequency}}' => $t['columns']['frequency'],
            '{{col_lastmod}}'   => $t['columns']['lastmod'],
        ]);
    }

    public static function content(): string
    {
        return <<<'XSL'
<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="2.0"
                xmlns:html="http://www.w3.org/TR/REC-html40"
                xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"
                xmlns:sitemap="http://www.sitemaps.org/schemas/sitemap/0.9"
                xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:output method="html" version="1.0" encoding="UTF-8" indent="yes"/>
    <xsl:template match="/">
        <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
                <title>{{title}}</title>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" />
                <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" />
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
                <link href="https://fonts.googleapis.com/css?family=Open+Sans&amp;subset=latin-ext" rel="stylesheet" />
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
                <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
                <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
                <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
                <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
                <script type="text/javascript"><![CDATA[
                    $(document).ready(function () {
                        $('#sitemap').DataTable({
                            responsive: true,
                            pageLength: 25,
                            language: {
                                search: "{{dt_search}}",
                                lengthMenu: "{{dt_lengthMenu}}",
                                info: "{{dt_info}}",
                                infoFiltered: "{{dt_infoFiltered}}",
                                infoEmpty: "{{dt_infoEmpty}}",
                                zeroRecords: "{{dt_zeroRecords}}",
                                paginate: {
                                    first: "{{dt_first}}",
                                    last: "{{dt_last}}",
                                    next: "{{dt_next}}",
                                    previous: "{{dt_previous}}"
                                }
                            }
                        });
                    });
                    ]]></script>
                <style type="text/css">
                    html, body {
                        font-family: 'Open Sans', sans-serif !important;
                        font-weight: 400;
                    }

                    .table-responsive {
                        overflow-x: auto;
                        -webkit-overflow-scrolling: touch;
                    }

                    table {
                        white-space: nowrap;
                    }

                    .expl {
                        line-height: 1.3em;
                        margin: 10px 3px 16px;
                    }

                    .expl a {
                        color: #222;
                        font-weight: bold;
                    }

                    a {
                        color: #000;
                        text-decoration: none;
                    }

                    a:visited {
                        color: #777;
                    }

                    a:hover {
                        text-decoration: underline;
                    }

                    .custom-breadcrumb {
                        background-color: #f8f9fa;
                        padding: 0.75rem 1rem;
                        margin-top: 1.5rem;
                        margin-bottom: 2rem;
                        border-radius: 0.5rem;
                        box-shadow: inset 0 0 0 1px rgba(0, 0, 0, 0.05);
                        font-size: 0.95rem;
                    }

                    .custom-breadcrumb a {
                        color: #2b2f32;
                        font-weight: 500;
                        text-decoration: none;
                    }

                    .custom-breadcrumb a:hover {
                        text-decoration: underline;
                    }

                    .dataTables_wrapper .dataTables_paginate {
                        padding: 1.5rem 0 2rem 0;
                    }

                    td a {
                        display: inline-block;
                        max-width: 100%;
                        overflow: hidden;
                        white-space: nowrap;
                        text-overflow: ellipsis;
                        vertical-align: bottom;
                        text-align: left;
                    }

                    .dataTables_wrapper .dataTables_paginate .pagination .page-item .page-link {
                        color: #333;
                        background-color: #f0f0f0;
                        border-color: #ddd;
                        border-radius: 0.3rem;
                        margin: 0 2px;
                        padding: 0.375rem 0.75rem;
                        font-weight: 500;
                    }

                    .dataTables_wrapper .dataTables_paginate .pagination .page-item.active .page-link {
                        background-color: #333;
                        color: #fff;
                        border-color: #333;
                    }

                    .dataTables_wrapper .dataTables_paginate .pagination .page-item:hover .page-link {
                        background-color: #ccc;
                        color: #000;
                    }
                </style>
            </head>
            <body>
                <div class="container-fluid">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb custom-breadcrumb" dir="ltr">
                            <li class="breadcrumb-item"><a href="/">{{breadcrumb}}</a></li>
                        </ol>
                    </nav>
                    <div class="row">
                        <div class="col-12">
                            <h1 class="mb-3">{{heading}}</h1>
                            <p class="expl">{{generated}}</p>
                            <div class="table-responssive">
                                <table id="sitemap" class="table table-striped table-bordered table-hover nowrap" style="width:100%">
                                <thead>
                                        <tr>
                                            <th scope="col">{{col_url}}</th>
                                            <th scope="col">{{col_priority}}</th>
                                            <th scope="col">{{col_frequency}}</th>
                                            <th scope="col">{{col_lastmod}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <xsl:variable name="lower" select="'abcdefghijklmnopqrstuvwxyz'" />
                                        <xsl:variable name="upper" select="'ABCDEFGHIJKLMNOPQRSTUVWXYZ'" />
                                        <xsl:for-each select="sitemap:urlset/sitemap:url">
                                            <tr>
                                                <td>
                                                    <xsl:variable name="itemURL">
                                                        <xsl:value-of select="sitemap:loc" />
                                                    </xsl:variable>
                                                    <xsl:variable name="displayURL">
                                                        <xsl:choose>
                                                            <xsl:when test="string-length($itemURL) &gt; 160">
                                                                <xsl:value-of select="concat(substring($itemURL, 1, 157), '…')" />
                                                            </xsl:when>
                                                            <xsl:otherwise>
                                                                <xsl:value-of select="$itemURL" />
                                                            </xsl:otherwise>
                                                        </xsl:choose>
                                                    </xsl:variable>
                                                    <a href="{$itemURL}" title="{$itemURL}" rel="noopener noreferrer" target="_blank">
                                                        <xsl:value-of select="$displayURL" />
                                                    </a>
                                                </td>
                                                <td>
                                                    <xsl:value-of select="concat(sitemap:priority*100,'%')" />
                                                </td>
                                                <td>
                                                    <xsl:value-of select="concat(translate(substring(sitemap:changefreq, 1, 1),concat($lower, $upper),concat($upper, $lower)),substring(sitemap:changefreq, 2))" />
                                                </td>
                                                <td>
                                                    <xsl:value-of select="concat(substring(sitemap:lastmod,0,11),concat(' ', substring(sitemap:lastmod,12,5)))" />
                                                </td>
                                            </tr>
                                        </xsl:for-each>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>

XSL;

    }
}

