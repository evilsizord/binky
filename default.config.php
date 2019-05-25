<?php
/**
 * Binky configuration file: Default format
 */

$BinkyConfig = array(

    array('selector' => 'container', 'template' => '
        <table class="container" {{=WIDTH}} {{=STYLE}} {{=BGCOLOR}} align="center" border="0" cellpadding="0" cellspacing="0">
        <tbody>
        <tr>
            <td {{=WIDTH}} {{=BGCOLOR}} {{=BACKGROUND}} >{{INNERTEXT}}</td>
        </tr>
        </tbody>
        </table>
    '),
    
    array('selector' => 'row', 'template' => '
        <table class="row" border="0" cellpadding="0" cellspacing="0" {{=WIDTH}} {{=STYLE}} {{=BGCOLOR}} {{=ALIGN}}>
        <tbody>
        <tr>
            {{INNERTEXT}}
        </tr>
        </tbody>
        </table>
    '),
    
    array('selector' => 'column', 'template' => '
        <td {{=WIDTH}} {{=BGCOLOR}} {{COLUMN-STYLE}} >{{INNERTEXT}}</td>
    '),

    array('selector' => 'p.default', 'template' => '
        <p style="padding: 0; margin: 0 0 10px 0; font-size: 16px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #333333; text-align: left;">{{INNERTEXT}}</p>
    '),
    
    array('selector' => 'a.default', 'template' => '
        <a style="text-decoration: underline; color: #2d70d2;" target="_blank" {{=HREF}}>{{INNERTEXT}}</a>
    '),

    array('selector' => 'img.default', 'template' => '
        <img {{=WIDTH}} {{=HEIGHT}} {{=SRC}} {{=ALT}} border="0" style="border:none; display:block;" />
    '),

    array('selector' => 'gapixel', 'template' => '
        <img height="1" src="https://www.google-analytics.com/collect?t=event&amp;v=1&amp;cm=email&amp;cn={{CN}}&amp;aip=1&amp;ea=open&amp;cid=555&amp;ec=email&amp;cs={{CS}}&amp;tid=UA-{{UA}}" width="1"/>
    '),
    
    array('selector' => 'spacer', 'template' => '
        <img {{=HEIGHT}} src="https://mysite.com/path/to/spacer.gif" {{=WIDTH}} />
    '),
    
    array('selector' => 'preheader', 'template' => '
        <div style="display: none; max-height: 0px; overflow: hidden;">
        {{INNERTEXT}}
        </div>

        <!-- Insert spaces hack after hidden preview text -->
        <!-- https://litmus.com/blog/the-little-known-preview-text-hack-you-may-want-to-use-in-every-email -->
        <div style="display: none; max-height: 0px; overflow: hidden;">
        &nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
        </div>
    ')
);


return $BinkyConfig;

