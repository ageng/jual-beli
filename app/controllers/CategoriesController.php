<?php

class CategoriesController extends BaseController {

	public function __construct() {
		$this->beforeFilter('csrf', array('on'=>'post'));
		$this->beforeFilter('admin');
	}

	public function getIndex() {
		return View::make('categories.index')
			->with('categories', Category::all());
	}

	public function postCreate() {
		$validator = Validator::make(Input::all(), Category::$rules);

		if ($validator->passes()) {
			$category = new Category;
			$category->name = Input::get('name');
			$category->save();

			return Redirect::to('admin/categories/index')
				->with('message', 'Kategori baru berhasil dibuat');
		}

		return Redirect::to('admin/categories/index')
			->with('message', 'Terjadi kesalahan.')
			->withErrors($validator)
			->withInput();
	}

	public function postDestroy() {
		$category = Category::find(Input::get('id'));

		if ($category) {
			$category->delete();
			return Redirect::to('admin/categories/index')
				->with('message', 'Kategori berhasil dihapus');
		}

		return Redirect::to('admin/categories/index')
			->with('message', 'Terjadi kesalahan, silahkan diulangin kembali.');
	}
}