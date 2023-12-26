<?php

namespace App\Http\Livewire;

use App\Models\Survey;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Responsive;
use PowerComponents\LivewirePowerGrid\Filters\Filter;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\{ActionButton, WithExport};
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridColumns};

final class SurveysTable extends PowerGridComponent
{
    use ActionButton;
    use WithExport;

    public string $primaryKey = 'surveys.id';
    public string $sortField = 'created_at';
    public string $sortDirection = 'desc';
    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): array
    {
        $this->persist(['columns', 'filters']);

        $this->showCheckBox();

        return [
            Exportable::make('tree-tracker_surveys_'.Carbon::now())
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),

            Header::make()
                ->showSearchInput(),
                // ->showToggleColumns()
              //  ->includeViewOnTop('survey.datatable-header'),

            Footer::make()
                ->showPerPage()
                ->showRecordCount(),

            Responsive::make(),
        ];
    }

    public function header(): array
    {
        return [
            Button::add('surveys-save')
                ->caption('Create a new survey')
                ->class('create-button')
                ->openModal('surveys-save', []),

            //...
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */

    /**
     * PowerGrid datasource.
     *
     * @return Builder<\App\Models\Survey>
     */
    public function datasource(): Builder
    {
        return Survey::query()
            ->join('projects', function ($projects) {
                $projects->on('surveys.project_id', '=', 'projects.id');
            })
            ->select([
                'surveys.id',
                'surveys.project_id',
                'surveys.name',
                'surveys.created_at',
                'projects.name as project_name'
            ]);
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */

    /**
     * Relationship search.
     *
     * @return array<string, array<int, string>>
     */
    public function relationSearch(): array
    {
        return [
            'project' => [
                'name',
            ],
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    | ❗ IMPORTANT: When using closures, you must escape any value coming from
    |    the database using the `e()` Laravel Helper function.
    |
    */
    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('project', function (Survey $model) {
                return $model->project->name;
            })
            ->addColumn('survey', function (Survey $model) {
                return $model->name;
            })

            ->addColumn('project_name', function (Survey $model) {
                    return '<a href="'.route("projects.show", $model->project->id).'">'. e($model->project->name) .'</a>';
                })
            ->addColumn('survey_name', function (Survey $model) {
                return '<a href="'.route("surveys.show", $model->id).'">'. e($model->name) .'</a>';
            })
            ->addColumn('created_at_formatted', fn (Survey $model) => Carbon::parse($model->created_at)->format('d/m/Y'));
    }

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */

     /**
      * PowerGrid Columns.
      *
      * @return array<int, Column>
      */
    public function columns(): array
    {
        return [
            Column::make('Id', 'id')->hidden(),
            Column::make('Project', 'project', 'project_name')
                ->visibleInExport(true)
                ->hidden(),
            Column::make('Project', 'project_name')
                ->visibleInExport(false)
                ->sortable(),
            // ->searchable()
            Column::make('Name', 'survey_name')
                ->visibleInExport(false)
                ->sortable()
                ->searchable(),
            Column::make('Name', 'survey','survey_name')
                ->visibleInExport(true)
                ->hidden(),
            Column::make('Created at', 'created_at_formatted', 'surveys.created_at')
                ->sortable()

        ];
    }

    /**
     * PowerGrid Filters.
     *
     * @return array<int, Filter>
     */
    public function filters(): array
    {
        return [
            // Filter::datetimepicker('surveys.created_at'),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

    /**
     * PowerGrid Survey Action Buttons.
     *
     * @return array<int, Button>
     */

     public function actions(): array
     {
        return [
            Button::make('assign', '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                                    </svg>')
                 ->class('inline-flex items-center px-2 py-1 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-green-700 bg-white hover:bg-green-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500')
                 ->openModal('surveys-participants', ['survey' => 'id']),

             Button::make('edit', '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                   </svg>')
                 ->class('inline-flex items-center px-2 py-1 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-blue-700 bg-white hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500')
                 ->openModal('surveys-save', ['survey' => 'id']),

             Button::make('destroy', '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>')
                ->class('inline-flex items-center px-2 py-1 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-red-700 bg-white hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500')
                ->openModal('surveys-delete', ['survey' => 'id']),
         ];
     }

    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

    /**
     * PowerGrid Survey Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($survey) => $survey->id === 1)
                ->hide(),
        ];
    }
    */

    protected function getListeners()
    {
        return array_merge(
            parent::getListeners(),
            [
                'refreshTable',
            ]
        );
    }


    public function refreshTable(): void
    {
       $this->emit('pg:eventRefresh-default');
    }
}
