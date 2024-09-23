<?php

namespace App\Trait;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

trait BaseModel
{

    public function __construct(protected Model $model)
    {
        $this->model = $model;
    }

    public function customPaginate(
        $columns = ['*'],
        $relations = [],
        $perPage = 10,
        $orderBy = null,
        $search = null,
        $customWhere = [],
        $searchColumns = [],
        $relationSearchColumns = [],
        $filters = [],
        $all = false,
        $direction = 'desc',
    ) {
        // Khởi tạo query với các quan hệ
        $query = $this->model->query()->with($relations);

        // Áp dụng tìm kiếm
        if ($search && !empty($searchColumns)) {
            $query = $this->applySearch($query, $search, $searchColumns, $relationSearchColumns);
        }

        // Áp dụng điều kiện tùy chỉnh
        if (!empty($customWhere)) {
            $query = $this->applyCustomWhere($query, $customWhere);
        }

        // Áp dụng các bộ lọc
        if (!empty($filters)) {
            $query = $this->applyFilters($query, $filters);
        }

        // Áp dụng sắp xếp
        if ($orderBy) {
            $query->orderBy($orderBy, $direction);
        }

        // Phân trang hoặc lấy tất cả
        return $all ? $query->get() : $query->paginate($perPage, $columns);
    }

    private function applySearch($query, $search, $searchColumns, $relationSearchColumns)
    {
        return $query->where(function (Builder $query) use ($search, $searchColumns, $relationSearchColumns) {
            foreach ($searchColumns as $column) {
                $query->orWhere($column, 'like', "%{$search}%");
            }
            foreach ($relationSearchColumns as $relation => $columns) {
                foreach ($columns as $column) {
                    $query->orWhereHas($relation, function (Builder $query) use ($search, $column) {
                        $query->where($column, 'like', "%{$search}%");
                    });
                }
            }
        });
    }

    private function applyCustomWhere($query, $customWhere)
    {
        return $query->where(function (Builder $query) use ($customWhere) {
            foreach ($customWhere as $key => $value) {
                $query->where($key, $value);
            }
        });
    }

    private function applyFilters($query, $filters)
    {
        foreach ($filters as $key => $value) {
            if ($value) {
                $query->where($key, $value);
            }
        }
        return $query;
    }
}
