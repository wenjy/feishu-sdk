<?php

namespace FeiShu\Kernel;

use FeiShu\Kernel\Contracts\Arrayable;
use FeiShu\Kernel\Exceptions\RuntimeException;
use FeiShu\Kernel\Support\Arr;
use FeiShu\Kernel\Support\Collection;

function data_get($data, $key, $default = null)
{
    switch (true) {
        case is_array($data):
            return Arr::get($data, $key, $default);
        case $data instanceof Collection:
            return $data->get($key, $default);
        case $data instanceof Arrayable:
            return Arr::get($data->toArray(), $key, $default);
        case $data instanceof \ArrayIterator:
            return $data->getArrayCopy()[$key] ?? $default;
        case $data instanceof \ArrayAccess:
            return $data[$key] ?? $default;
        case $data instanceof \IteratorAggregate && $data->getIterator() instanceof \ArrayIterator:
            return $data->getIterator()->getArrayCopy()[$key] ?? $default;
        case is_object($data):
            return $data->{$key} ?? $default;
        default:
            throw new RuntimeException(sprintf('Can\'t access data with key "%s"', $key));
    }
}

function data_to_array($data)
{
    switch (true) {
        case is_array($data):
            return $data;
        case $data instanceof Collection:
            return $data->all();
        case $data instanceof Arrayable:
            return $data->toArray();
        case $data instanceof \IteratorAggregate && $data->getIterator() instanceof \ArrayIterator:
            return $data->getIterator()->getArrayCopy();
        case $data instanceof \ArrayIterator:
            return $data->getArrayCopy();
        default:
            throw new RuntimeException(sprintf('Can\'t transform data to array'));
    }
}
