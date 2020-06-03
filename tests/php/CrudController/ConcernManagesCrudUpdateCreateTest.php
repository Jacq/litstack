<?php

namespace FjordTest\CrudController;

use Mockery as m;
use FjordTest\BackendTestCase;
use Fjord\Crud\Controllers\Concerns\ManagesCrudUpdateCreate;
use Fjord\Crud\Requests\CrudUpdateRequest;

class ConcernManagesCrudUpdateCreateTest extends BackendTestCase
{
    public function setUp(): void
    {
        $this->controller = new ManagesUpdateCreateController;
    }

    /** @test */
    public function test_fillModelAttributes_method_calls_fillModel_method_on_field_when_request_has_attribute()
    {
        $model = m::mock('model');
        $field = m::mock('field');
        $field->local_key = 'dummy_attribute_name';
        $field->shouldReceive('fillModel')->withArgs([$model, 'dummy_attribute_name', 'dummy value']);
        $request = m::mock('request');
        $request->shouldReceive('has')->withArgs(['dummy_attribute_name'])->andReturn(true);
        $request->dummy_attribute_name = 'dummy value';
        $this->controller->fillModelAttributes($model, $request, [$field]);
    }

    /** @test */
    public function test_filterRequestAttributes_method()
    {
        $request = m::mock('request');
        $request->shouldReceive('all')->andReturn([
            'dummy_attribute_name' => 'dummy value',
            'other_attribute' => 'other value'
        ]);
        $field = new ManagesUpdateCreateField;
        $field->local_key = 'dummy_attribute_name';

        $attributes = $this->controller->filterRequestAttributes($request, [$field]);

        $this->assertArrayHasKey('dummy_attribute_name', $attributes);
        $this->assertArrayHasKey('other_attribute', $attributes);

        // Assuming that dummy_attribute_name has been modified in format method of the field.
        $this->assertEquals('formatted value', $attributes['dummy_attribute_name']);
        $this->assertEquals('other value', $attributes['other_attribute']);
    }

    /** @test */
    public function test_update()
    {
        $request = m::mock(CrudUpdateRequest::class);
        $id = 1;
        $config = m::mock('config');
        $config->form = null;
        $model = m::mock('model');
        $model->last_edit = false;

        $request->shouldReceive('all')->andReturn([
            'dummy_attribute' => 'value',
            'other_attribute' => 'other'
        ]);
        $model->shouldReceive('update')->withArgs([
            [
                'dummy_attribute' => 'value',
                'other_attribute' => 'other'
            ]
        ]);

        $controller = m::mock(ManagesUpdateCreateControllerForUpdateTest::class)->makePartial();
        $controller->model = $model;
        $controller->config = $config;

        $controller->update($request, $id, 'form');
    }
}

class ManagesUpdateCreateField
{
    public function format($value)
    {
        return 'formatted value';
    }
}

class ManagesUpdateCreateController
{
    use ManagesCrudUpdateCreate;
}

class ManagesUpdateCreateControllerForUpdateTest
{
    use ManagesCrudUpdateCreate;

    public function getForm(...$params)
    {
        return true;
    }

    public function formExists(...$params)
    {
        return true;
    }

    public function findOrFail(...$params)
    {
        return $this->model;
    }

    public function validate(...$params)
    {
        //
    }

    public function fields(...$params)
    {
        return [];
    }

    public function fillModelAttributes(...$params)
    {
        //
    }
}
