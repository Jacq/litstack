<?php

return [

    /*
    |--------------------------------------------------------------------------
    | CRUD Translations
    |--------------------------------------------------------------------------
    |
    | The crud translations include all translations related to the litstack
    | crud system. This includes fields and other parts of the crud pages.
    |
    */

    'preview'          => 'Preview',
    'of'               => 'of',
    'n_items_selected' => ':count item selected | :count items selected',

    'messages' => [
        'not_created' => ':model has to be created in order to add <i>:relation</i>.',
    ],

    'fields' => [
        'blocks' => [
            'expand'       => 'expand',
            'expand_all'   => 'expand all',
            'collapse_all' => 'collapse all',
            'messages'     => [
                'new_block' => 'Added new :type block',

            ],
        ],
        'relation' => [
            'goto'     => 'Go to relation',
            'unlink'   => 'Unlink relation',
            'edit'     => 'Edit relation',
            'messages' => [
                'relation_linked'   => '{relation} successfully linked.',
                'relation_unlinked' => 'Relation unlinked.',
                'confirm_unlink'    => 'Please confirm that you wish to unlink the item.',
                'max_items_reached' => 'A maximum of :count items can be selected.',
            ],
        ],
        'wysiwyg' => [
            'new_window' => 'open in new window',
        ],
        'list' => [
            'messages' => [
                'max_depth'           => 'The list can be nested a maximum of :count levels.',
                'confirm_delete'      => 'Should :item item really be deleted?',
                'confirm_delete_info' => 'If you remove this item, you also remove all child items below it.',
            ],
        ],
    ],
    'meta' => [
        'title_hint'       => 'Easily understandable meaningful sentence. Gives an idea what the page content is about. Maximum :width wide.',
        'keywords_hint'    => 'The most important keywords of the page content. Single (few) words separated by commas.',
        'description_hint' => 'Short but meaningful summary of the page. Contains the most important keywords of the page content.',
    ],
];
