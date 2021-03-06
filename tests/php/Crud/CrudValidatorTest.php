<?php

namespace Tests\Crud;

use Ignite\Crud\CrudValidator;
use Mockery as m;
use Tests\BackendTestCase;

class CrudValidatorTest extends BackendTestCase
{
    /** @test */
    public function it_returns_correct_attribute_names()
    {
        $form = m::mock('form');
        $field = m::mock('field');

        $form->shouldReceive('getRegisteredFields')->andReturn(collect([$field]));
        $field->local_key = 'dummy_field';
        $field->translatable = false;
        $field->shouldReceive('getTitle')->andReturn('Dummy Title');

        $names = $this->callUnaccessibleMethod(CrudValidator::class, 'getValidationAttributeNames', [$form]);

        $this->assertArrayHasKey('dummy_field', $names);
        $this->assertEquals('Dummy Title', $names['dummy_field']);
    }

    /** @test */
    public function it_returns_correct_attribute_names_for_translated_fields()
    {
        $form = m::mock('form');
        $field = m::mock('field');

        $form->shouldReceive('getRegisteredFields')->andReturn(collect([$field]));
        $field->local_key = 'dummy_field';
        $field->translatable = true;
        $field->shouldReceive('getTitle')->andReturn('Dummy Title');

        // Test for locales: de, en
        $this->app['config']->set('translatable.locales', ['de', 'en']);

        $names = $this->callUnaccessibleMethod(CrudValidator::class, 'getValidationAttributeNames', [$form]);

        $this->assertArrayHasKey('de.dummy_field', $names);
        $this->assertArrayHasKey('en.dummy_field', $names);
        $this->assertEquals('Dummy Title (de)', $names['de.dummy_field']);
        $this->assertEquals('Dummy Title (en)', $names['en.dummy_field']);
    }
}
