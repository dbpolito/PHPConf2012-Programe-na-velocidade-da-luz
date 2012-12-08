<?php
class Model_Category extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'parent_id',
		'title',
		'description',
		'status',
		'created_at',
		'updated_at',
	);

	protected static $_belongs_to = array(
		'parent' => array(
			'key_from' => 'parent_id',
			'model_to' => 'Model_Category',
			'key_to' => 'id',
			'cascade_save' => true,
			'cascade_delete' => false,
		)
	);

	protected static $_has_many = array(
		'childrens' => array(
			'key_from' => 'id',
			'model_to' => 'Model_Category',
			'key_to' => 'parent_id',
			'cascade_save' => true,
			'cascade_delete' => false,
			'conditions' => array(
				'order_by' => array('title') // ORDERING THE CHILDREN RESULT
			)
		),
		'posts' => array(
			'key_from' => 'id',
			'model_to' => 'Model_Post',
			'key_to' => 'category_id',
			'cascade_save' => true,
			'cascade_delete' => false,
		)
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_save'),
			'mysql_timestamp' => false,
		),
	);

	public static function validate($factory)
	{
		$val = Validation::forge($factory);
		$val->add_field('parent_id', 'Parent', 'max_length[255]');
		$val->add_field('title', 'Title', 'required|max_length[255]');
		$val->add_field('description', 'Description', 'required');
		$val->add_field('status', 'Status', 'required');

		return $val;
	}

	/**
	 * Gets the category tree ready for selects or tables
	 *
	 * @param  string  $type       select|object
	 * @param  array   $categories Array of categories
	 * @param  integer $level      Level of the hierachy
	 *
	 * @return array               List of Categories
	 */
	public static function get_category_tree($type = 'select', $categories = null, $level = 0)
	{
		$tree       = $type == 'select' ? array('' => '') : array();
		$prefix     = str_repeat('&nbsp;', $level * 3);

		// THE FIRST TIME THIS IS CALLED IT GETS ALL ROOT CATEGORIES
		if ($categories === null)
		{
			$categories = Model_Category::query()
				->where('parent_id', 0)
				->get();
		}

		if ($categories)
		{
			foreach ($categories as $category)
			{
				if ($type == 'select')
				{
					$tree[$category->id] = $prefix.$category->title;
				}
				else
				{
					$category->level = $level;
					$tree[$category->id] = $category;
				}

				if ($category->childrens)
				{
					$childrens = static::get_category_tree($type, $category->childrens, $level + 1);

					$tree      = $tree + $childrens; // MERGE THE RESULT WITHOUT LOOSING THE ORDER
				}
			}
		}

		return $tree;
	}

}
