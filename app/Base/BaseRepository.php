<?php

namespace App\Base;

use App\Interfaces\Models\BaseModelInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Container\Container as Application;

abstract class BaseRepository
{
    /**
     * @var BaseModelInterface
     */
    protected BaseModelInterface $model;

    /**
     * @var Application
     */
    protected Application $app;

    /**
     * @param Application $app
     *
     * @throws \Exception
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    /**
     * @return string
     */
    abstract public function model(): string;

    /**
     * Make Model instance
     *
     * @throws \Exception
     *
     * @return BaseModelInterface
     */
    public function makeModel(): BaseModelInterface
    {
        $model = $this->app->make($this->model());

        if (!$model instanceof BaseModelInterface) {
            throw new \Exception(
                __(
                    'class_must_beInstance_of',
                    ['model' => $this->model(), 'parent' => 'Illuminate\\Database\\Eloquent\\Model']
                )
            );
        }

        return $this->model = $model;
    }

    /**
     * @param array $data Data.
     * @return array|BaseModelInterface
     */
    public function store(array $data): array|BaseModelInterface
    {
        // $this->model::createObject();

        return $this->model;
    }

    /**
     * @param BaseModelInterface $model
     * @param $data
     * @return mixed
     */
    public function update(BaseModelInterface $model, $data): BaseModelInterface
    {
        // $this->model->updateObject();

        return $model;
    }

    /**
     * @param BaseModelInterface $model
     * @return void
     */
    public function delete(BaseModelInterface $model): void
    {
        $model->delete();
    }

    /**
     * @param BaseModelInterface $model
     * @return BaseModelInterface
     */
    public function show(BaseModelInterface $model): BaseModelInterface
    {
        return $model; //$model->load('...')
    }

    /**
     * Find model record for given id
     *
     * @param integer $id
     * @param array   $columns
     *
     * @return BaseModelInterface
     */
    public function find($id, $columns = ['*']): BaseModelInterface
    {
        $query = $this->model->newQuery();

        return $query->find($id, $columns);
    }

    /**
     * @param bool $paginate Paginate
     * @return mixed
     */
    public function all(bool $paginate = false): mixed
    {
        return $this->model::when(
                $paginate,
                fn(Builder $builder) => $builder->paginate(),
                fn(Builder $builder) => $builder->get()
            );
    }
}
