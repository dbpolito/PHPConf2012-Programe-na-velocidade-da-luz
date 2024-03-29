<?php
class Controller_Admin_Categories extends Controller_Admin
{

	public function action_index()
	{
		$data['categories'] = Model_Category::get_category_tree('object');

		$this->template->title = "Categories";
		$this->template->content = View::forge('admin/categories/index', $data);
	}

	public function action_view($id = null)
	{
		$data['category'] = Model_Category::find($id);

		$this->template->title = "Category";
		$this->template->content = View::forge('admin/categories/view', $data);
	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Category::validate('create');

			if ($val->run())
			{
				$category = Model_Category::forge(array(
					'parent_id' => Input::post('parent_id') ?: 0,
					'title' => Input::post('title'),
					'description' => Input::post('description'),
					'status' => Input::post('status'),
				));

				if ($category and $category->save())
				{
					Session::set_flash('success', e('Added category #'.$category->id.'.'));

					Response::redirect('admin/categories');
				}
				else
				{
					Session::set_flash('error', e('Could not save category.'));
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->set_global('categories', Model_Category::get_category_tree());

		$this->template->title = "Categories";
		$this->template->content = View::forge('admin/categories/create');
	}

	public function action_edit($id = null)
	{
		$category = Model_Category::find($id);
		$val = Model_Category::validate('edit');

		if ($val->run())
		{
			$category->parent_id = Input::post('parent_id') ?: 0;
			$category->title = Input::post('title');
			$category->description = Input::post('description');
			$category->status = Input::post('status');

			if ($category->save())
			{
				Session::set_flash('success', e('Updated category #' . $id));

				Response::redirect('admin/categories');
			}
			else
			{
				Session::set_flash('error', e('Could not update category #' . $id));
			}
		}
		else
		{
			if (Input::method() == 'POST')
			{
				$category->parent_id = $val->validated('parent_id');
				$category->title = $val->validated('title');
				$category->description = $val->validated('description');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('category', $category, false);
		}

		$this->template->set_global('categories', Model_Category::get_category_tree());

		$this->template->title = "Categories";
		$this->template->content = View::forge('admin/categories/edit');
	}

	public function action_delete($id = null)
	{
		if ($category = Model_Category::find($id))
		{
			$category->delete();

			Session::set_flash('success', e('Deleted category #'.$id));
		}
		else
		{
			Session::set_flash('error', e('Could not delete category #'.$id));
		}

		Response::redirect('admin/categories');
	}
}