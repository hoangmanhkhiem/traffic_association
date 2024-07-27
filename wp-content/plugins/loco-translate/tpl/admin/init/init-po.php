<?php
/**
 * Initialize a new PO translations file
 */
$this->extend('../layout');

    /* @var Loco_mvc_ViewParams $params */
    /* @var Loco_mvc_ViewParams $prompt */
    if( $params->has('prompt') ):?> 
    <div class="panel panel-info">
        <p><?php 
            $prompt->e('title')?>.
            <a href="<?php $prompt->e('link')?>"><?php $prompt->e('text')?></a>.
        </p>
    </div><?php
    endif?> 


    <div class="panel">

        <h2><?php $params->e('subhead')?></h2>
        <p><?php $params->e('summary')?></p>

        <form action="" method="post" enctype="application/x-www-form-urlencoded" id="loco-poinit"><?php
            /* @var Loco_mvc_HiddenFields $hidden */
            $hidden->_e();?> 
            <table class="form-table">
                <tbody class="loco-locales">
                    <tr>
                        <th scope="row">
                            <label for="loco-select-locale">
                                1. <?php esc_html_e('Choose a language','loco-translate')?>:
                            </label>
                        </th>
                        <td>
                            <fieldset>
                                <label for="loco-use-selector-1">
                                    <span><input type="radio" name="use-selector" value="1" checked id="loco-use-selector-1" /></span>
                                    <?php esc_attr_e('WordPress language','loco-translate')?>:
                                </label>
                                <div>
                                    <span class="lang nolang"></span>
                                    <select id="loco-select-locale" name="select-locale">
                                        <option value=""><?php esc_attr_e('No language selected','loco-translate')?></option>
                                        <optgroup label="<?php esc_attr_e( 'Installed languages', 'loco-translate' )?>"><?php
                                            /* @var Loco_mvc_ViewParams[] $installed */
                                            foreach( $installed as $option ):?> 
                                            <option value="<?php $option->e('value')?>" data-icon="<?php $option->e('icon')?>"<?php $option->e('selected')?>><?php $option->e('label')?></option><?php
                                            endforeach;?> 
                                        </optgroup>
                                        <optgroup label="<?php esc_attr_e( 'Available languages', 'loco-translate' )?>"><?php
                                            /* @var Loco_mvc_ViewParams[] $locales */
                                            foreach( $locales as $option ):?> 
                                            <option value="<?php $option->e('value')?>" data-icon="<?php $option->e('icon')?>"<?php $option->e('selected')?>><?php $option->e('label')?></option><?php
                                            endforeach;?> 
                                        </optgroup>
                                    </select>
                                </div>
                            </fieldset>
                            <fieldset class="disabled">
                                <label for="loco-use-selector-0">
                                    <span><input type="radio" name="use-selector" value="0" id="loco-use-selector-0" <?php $params->has('custom') && print 'checked '?>/></span>
                                    <?php esc_attr_e('Custom language','loco-translate')?>:
                                </label>
                                <div>
                                    <span class="lang nolang"></span>
                                    <span class="loco-clearable"><input type="text" maxlength="14" name="custom-locale" value="<?php $params->e('custom')?>" /></span>
                                </div>
                            </fieldset>
                        </td>
                    </tr>
                </tbody>
                <tbody class="loco-paths">   
                    <tr valign="top">
                        <th scope="row">
                            <label>
                                2. <?php esc_html_e('Choose a location','loco-translate')?>:
                            </label>
                        </th>
                        <td>
                            <a href="<?php
                            /* @var Loco_mvc_ViewParams $help */
                            $help->e('href')?>#locations" class="has-icon icon-help" target="_blank" tabindex="-1"><?php $help->e('text')?></a>
                        </td>
                    </tr><?php
                    $choiceId = 0;
                    /* @var Loco_mvc_ViewParams[] $locations */
                    foreach( $locations as $typeId => $location ):?> 
                    <tr class="compact">
                        <td>
                            <p class="description"><?php $location->e('label')?>:</p>
                        </td>
                        <td><?php
                        /* @var Loco_mvc_FileParams $choice */
                        /* @var Loco_mvc_FileParams $parent */
                        foreach( $location['paths'] as $choice ): 
                            $parent = $choice['parent']; 
                            $offset = sprintf('%u',++$choiceId);?> 
                            <p><?php
                                if( $choice->disabled ):?> 
                                <label class="for-disabled">
                                    <span class="icon icon-lock"></span>
                                    <input type="radio" name="select-path" class="disabled" disabled /><?php
                                else:?> 
                                <label>
                                    <input type="radio" name="select-path" value="<?php echo $offset?>" <?php echo $choice->checked?> />
                                    <input type="hidden" name="path[<?php echo $offset?>]" value="<?php $choice->e('hidden')?>" /><?php
                                endif?> 
                                    <code class="path"><?php $parent->e('relpath')?>/<?php echo $choice->holder?></code>
                                </label>
                            </p><?php
                        endforeach?> 
                        </td>
                    </tr><?php
                    endforeach;?> 
                </tbody><?php
    
                if( $params->has('sourceLocale') ):?> 
                <tbody id="loco-copy" data-locale="<?php $params->e('sourceLocale')?>">
                    <tr>
                        <th scope="row" rowspan="4">
                            3. <?php esc_html_e('Template options','loco-translate')?>:
                        </th>
                        <td>
                            <a href="<?php $help->e('href')?>#copy" class="has-icon icon-help" target="_blank" tabindex="-1"><?php $help->e('text')?></a>
                        </td>
                    </tr>
                    <tr class="compact">
                        <td>
                            <p>
                                <label>
                                    <input type="radio" name="strip" value="" />
                                    <?php $params->f('sourceLocale', __('Copy target translations from "%s"','loco-translate') )?> 
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input type="radio" name="strip" value="1" checked />
                                    <?php esc_html_e('Just copy English source strings','loco-translate')?> 
                                </label>
                            </p>
                        </td>
                    </tr>
                    <tr class="compact">
                        <td>
                            <p>
                                <label>
                                    <input type="checkbox" name="json" value="1" checked />
                                    <?php esc_html_e('Merge strings from related JSON files','loco-translate')?>
                                </label>
                            </p>
                        </td>
                    </tr>
                    <tr class="compact">
                        <td>
                            <p>
                                <label>
                                    <input type="checkbox" name="link" value="1" checked />
                                    <?php esc_html_e('Use this file as template when running Sync','loco-translate')?>
                                </label>
                            </p>
                        </td>
                    </tr>
                </tbody><?php
                endif?> 
            </table>
    
            <p class="submit">
                <button type="submit" class="button button-large button-primary" disabled><?php esc_html_e('Start translating','loco-translate')?></button>
            </p>
    
        </form>

    </div>