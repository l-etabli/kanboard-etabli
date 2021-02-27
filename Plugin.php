<?php

namespace Kanboard\Plugin\Etabli;

use Kanboard\Core\Plugin\Base;

class Plugin extends Base {

	public function initialize() {

		global $EtabliConfig;

		require_once('plugins/Etabli/Config.php');

		if (isset($EtabliConfig['logo'])) {
			$this->template->setTemplateOverride('header/title', 'Etabli:logo');
		}

		$this->template->setTemplateOverride( 'board/table_container', 'Etabli:table_container' );
		$this->template->setTemplateOverride( 'task/details', 'Etabli:task_details' );
		$this->template->setTemplateOverride( 'task/layout', 'Etabli:task_layout' );
		$this->template->setTemplateOverride( 'project_header/header', 'Etabli:project_header' );
		$this->template->setTemplateOverride( 'board/task_private', 'Etabli:task_private' );
		$this->template->setTemplateOverride( 'board/task_public', 'Etabli:task_public' );
		$this->template->setTemplateOverride( 'board/task_avatar', 'Etabli:task_avatar' );
		$this->template->setTemplateOverride( 'board/task_footer', 'Etabli:task_footer' );
		$this->template->setTemplateOverride( 'board/table_column', 'Etabli:table_column' );
		$this->template->setTemplateOverride( 'board/table_tasks', 'Etabli:table_tasks' );
		$this->template->setTemplateOverride( 'twofactor/check', 'Etabli:check' );
		$this->template->setTemplateOverride( 'task/show', 'Etabli:show' );
		$this->template->setTemplateOverride( 'project_overview/columns', 'Etabli:columns' );
		$this->template->setTemplateOverride( 'comment/show', 'Etabli:comment_show' );
		$this->template->setTemplateOverride( 'dashboard/projects', 'Etabli:projects' );
		$this->template->setTemplateOverride( 'project_list/listing', 'Etabli:projects_listing' );
		$this->template->setTemplateOverride( 'user_list/listing', 'Etabli:users_listing' );
		$this->template->setTemplateOverride( 'group/users', 'Etabli:group_users' );
		$this->template->setTemplateOverride( 'user_list/user_title', 'Etabli:user_title' );
		$this->template->setTemplateOverride( 'header/user_dropdown', 'Etabli:user_dropdown' );
		$this->template->setTemplateOverride( 'task_list/task_avatars', 'Etabli:task_avatars' );
		$this->template->setTemplateOverride( 'user_view/profile', 'Etabli:profile' );
		$this->template->setTemplateOverride( 'auth/index', 'Etabli:login' );
		$this->template->setTemplateOverride( 'password_reset/create', 'Etabli:password_reset' );
		$this->template->setTemplateOverride( 'project_header/search', 'Etabli:search' );
		$this->template->setTemplateOverride( 'board/view_private', 'Etabli:view_private' );
		$this->template->setTemplateOverride( 'project_header/views', 'Etabli:project_header/views' );		
		$this->template->setTemplateOverride( 'plugin/show', 'Etabli:plugin/show' );		

		$this->container['colorModel'] = $this->container->factory( function ( $c ) {
			return new ColorModel( $c );
		} );

		$this->container['taskCreationModel'] = $this->container->factory( function ( $c ) {
			return new TaskCreationModel( $c );
		} );

		$this->helper->register( 'myTaskHelper', '\Kanboard\Plugin\Etabli\MyTaskHelper' );
		$this->helper->register( 'myAvatarHelper', '\Kanboard\Plugin\Etabli\MyAvatarHelper' );
		$this->helper->register( 'myFormHelper', '\Kanboard\Plugin\Etabli\MyFormHelper' );
		$this->helper->register( 'myProjectHeaderHelper', '\Kanboard\Plugin\Etabli\MyProjectHeaderHelper' );
		$this->helper->register( 'myUrlHelper', '\Kanboard\Plugin\Etabli\MyUrlHelper' );

		$this->setContentSecurityPolicy( array( 'font-src' => "'self' fonts.gstatic.com" ) );

		$manifest = json_decode( file_get_contents( __DIR__ . '/dist/rev-manifest.json', true ), true );

		$this->hook->on( "template:layout:css", array( "template" => "plugins/Etabli/dist/" . $manifest['main.css'] ) );
	}

	public function getPluginName() {
		return 'Etabli';
	}

	public function getPluginAuthor() {
		return 'L\'Établi';
	}

	public function getPluginVersion() {
		return '1.3.0';
	}

	public function getPluginHomepage() {
		return 'https://github.com/l-etabli/kanboard-etabli';
	}

	public function getPluginDescription() {
		return t( 'This plugin add a new stylesheet and override default styles.' );
	}
}
