<?php

namespace SilverStripe\CheckboxGroupField\Extensions;

use DNADesign\TextCheckboxGroup\Forms\TextCheckboxGroupField;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\Tab;
use SilverStripe\Forms\TabSet;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataExtension;
use SilverStripe\ORM\ValidationResult;

/**
 * Class CheckboxGroupDataExtension
 * @package SilverStripe\CheckboxGroupField\Extensions
 */
class CheckboxGroupDataExtension extends DataExtension
{
    /**
     * @var array
     */
    private static $db = [
        'Title' => 'Varchar(255)',
        'ShowTitle' => 'Boolean',
    ];

    /**
     * @param FieldList $fields
     */
    public function updateCMSFields(FieldList $fields)
    {
        $field = TextCheckboxGroupField::create(
            TextField::create('Title', _t("{$this->owner->ClassName}.TitleLabel", 'Title (displayed if checked)')),
            CheckboxField::create('ShowTitle', _t("{$this->owner->ClassName}.ShowTitleLabel", 'Displayed'))
        )->setName('TitleAndDisplayed');

        if ($fields->dataFieldByName('ShowTitle')) {
            $fields->removeByName('ShowTitle');
        }

        if ($fields->dataFieldByName('Title')) {
            $fields->replaceField('Title', $field);
        } else {
            $firstField = null;
            $tabStructure = [];

            $fields->recursiveWalk(function ($var) use (&$firstField, &$tabStructure) {
                if ($firstField !== null && !empty($tabStructure)) return;

                if ($firstField === null && ($var instanceof Tab || $var instanceof TabSet)) {
                    $tabStructure[] = $var->getName();
                }

                if ((!$var instanceof Tab && !$var instanceof TabSet) && $firstField === null) {
                    $firstField = $var;
                }
            });

            $fields->addFieldToTab(implode('.', $tabStructure), $field, $firstField->getName());
        }
    }

    /**
     * Ensure a Title is entered if "ShowTitle" is checked on save.
     *
     * @param ValidationResult $validationResult
     * @throws \SilverStripe\ORM\ValidationException
     */
    public function validate(ValidationResult $validationResult)
    {
        $result = parent::validate($validationResult);

        if ($this->owner->ShowTitle && !$this->owner->Title) {
            $result->addError('To show the Title you must first enter a value.');
        }
    }
}
