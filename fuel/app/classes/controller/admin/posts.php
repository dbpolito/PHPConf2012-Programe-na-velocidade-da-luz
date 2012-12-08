<?php
class Controller_Admin_Posts extends Controller_Admin 
{

	public function action_index()
	{
		$data['posts'] = Model_Post::find('all');

		$this->template->title = "Posts";
		$this->template->content = View::forge('admin/posts/index', $data);
	}

	public function action_view($id = null)
	{
		$data['post'] = Model_Post::find($id);

		$this->template->title = "Post";
		$this->template->content = View::forge('admin/posts/view', $data);
	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Post::validate('create');

			if ($val->run())
			{
				$post = Model_Post::forge(array(
					'user_id' => Input::post('user_id'),
					'category_id' => Input::post('category_id'),
					'title' => Input::post('title'),
					'slug' => Inflector::friendly_title(Input::post('title'), '-', true),
					'summary' => Input::post('summary'),
					'body' => Input::post('body'),
					'status' => Input::post('status'),
				));

				if ($post and $post->save())
				{
					Session::set_flash('success', e('Added post #'.$post->id.'.'));

					Response::redirect('admin/posts');
				}
				else
				{
					Session::set_flash('error', e('Could not save post.'));
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$users = Arr::assoc_to_keyval(Model_User::find('all'), 'id', 'username');

		$this->template->set_global('users', $users);
		$this->template->set_global('categories', Model_Category::get_category_tree());

		$this->template->title = "Posts";
		$this->template->content = View::forge('admin/posts/create');

	}

	public function action_edit($id = null)
	{
		$post = Model_Post::find($id);
		$val = Model_Post::validate('edit');

		if ($val->run())
		{
			$post->user_id = Input::post('user_id');
			$post->category_id = Input::post('category_id');
			$post->title = Input::post('title');
			$post->slug = Inflector::friendly_title(Input::post('title'), '-', true);
			$post->summary = Input::post('summary');
			$post->body = Input::post('body');

			if ($post->save())
			{
				Session::set_flash('success', e('Updated post #' . $id));

				Response::redirect('admin/posts');
			}
			else
			{
				Session::set_flash('error', e('Could not update post #' . $id));
			}
		}
		else
		{
			if (Input::method() == 'POST')
			{
				$post->user_id = $val->validated('user_id');
				$post->category_id = $val->validated('category_id');
				$post->title = $val->validated('title');
				$post->slug = $val->validated('slug');
				$post->summary = $val->validated('summary');
				$post->body = $val->validated('body');
				$post->status = $val->validated('status');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('post', $post, false);
		}

		$users = Arr::assoc_to_keyval(Model_User::find('all'), 'id', 'username');

		$this->template->set_global('users', $users);
		$this->template->set_global('categories', Model_Category::get_category_tree());

		$this->template->title = "Posts";
		$this->template->content = View::forge('admin/posts/edit');
	}

	public function action_delete($id = null)
	{
		if ($post = Model_Post::find($id))
		{
			$post->delete();

			Session::set_flash('success', e('Deleted post #'.$id));
		}
		else
		{
			Session::set_flash('error', e('Could not delete post #'.$id));
		}

		Response::redirect('admin/posts');
	}
}