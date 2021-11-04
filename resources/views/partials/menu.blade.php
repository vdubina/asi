<aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 917px;">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">{{ trans('panel.site_title') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route("admin.home") }}">
                        <i class="fas fa-fw fa-tachometer-alt nav-icon">
                        </i>
                        <p>
                            {{ trans('global.dashboard') }}
                        </p>
                    </a>
                </li>
                @can('user_alert_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.user-alerts.index") }}" class="nav-link {{ request()->is("admin/user-alerts") || request()->is("admin/user-alerts/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-bell">

                            </i>
                            <p>
                                {{ trans('cruds.userAlert.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('user_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/users*") ? "menu-open" : "" }} {{ request()->is("admin/roles*") ? "menu-open" : "" }} {{ request()->is("admin/permissions*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-users">

                            </i>
                            <p>
                                {{ trans('cruds.userManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('user_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-user">

                                        </i>
                                        <p>
                                            {{ trans('cruds.user.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('role_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-briefcase">

                                        </i>
                                        <p>
                                            {{ trans('cruds.role.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('permission_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-unlock-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.permission.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('course_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/course-topics*") ? "menu-open" : "" }} {{ request()->is("admin/course-instructors*") ? "menu-open" : "" }} {{ request()->is("admin/course-products*") ? "menu-open" : "" }} {{ request()->is("admin/course-coupons*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-shopping-cart">

                            </i>
                            <p>
                                {{ trans('cruds.courseManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('course_topic_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.course-topics.index") }}" class="nav-link {{ request()->is("admin/course-topics") || request()->is("admin/course-topics/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-list-alt">

                                        </i>
                                        <p>
                                            {{ trans('cruds.courseTopic.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('course_instructor_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.course-instructors.index") }}" class="nav-link {{ request()->is("admin/course-instructors") || request()->is("admin/course-instructors/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-user-graduate">

                                        </i>
                                        <p>
                                            {{ trans('cruds.courseInstructor.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('course_product_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.course-products.index") }}" class="nav-link {{ request()->is("admin/course-products") || request()->is("admin/course-products/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-shopping-cart">

                                        </i>
                                        <p>
                                            {{ trans('cruds.courseProduct.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('course_coupon_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.course-coupons.index") }}" class="nav-link {{ request()->is("admin/course-coupons") || request()->is("admin/course-coupons/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-dollar-sign">

                                        </i>
                                        <p>
                                            {{ trans('cruds.courseCoupon.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('taxonomy_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/taxonomy-courses*") ? "menu-open" : "" }} {{ request()->is("admin/taxonomy-course-types*") ? "menu-open" : "" }} {{ request()->is("admin/taxonomy-address-types*") ? "menu-open" : "" }} {{ request()->is("admin/taxonomy-phone-types*") ? "menu-open" : "" }} {{ request()->is("admin/taxonomy-certification-types*") ? "menu-open" : "" }} {{ request()->is("admin/taxonomy-credit-types*") ? "menu-open" : "" }} {{ request()->is("admin/taxonomy-discount-types*") ? "menu-open" : "" }} {{ request()->is("admin/taxonomy-practice-types*") ? "menu-open" : "" }} {{ request()->is("admin/taxonomy-media-types*") ? "menu-open" : "" }} {{ request()->is("admin/taxonomy-media-providers*") ? "menu-open" : "" }} {{ request()->is("admin/taxonomy-media-deliveries*") ? "menu-open" : "" }} {{ request()->is("admin/taxonomy-arms-categories*") ? "menu-open" : "" }} {{ request()->is("admin/taxonomy-arms-codes*") ? "menu-open" : "" }} {{ request()->is("admin/taxonomy-ad-services*") ? "menu-open" : "" }} {{ request()->is("admin/taxonomy-professions*") ? "menu-open" : "" }} {{ request()->is("admin/taxonomy-web-categories*") ? "menu-open" : "" }} {{ request()->is("admin/taxonomy-content-block-types*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-tags">

                            </i>
                            <p>
                                {{ trans('cruds.taxonomyManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('taxonomy_course_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.taxonomy-courses.index") }}" class="nav-link {{ request()->is("admin/taxonomy-courses") || request()->is("admin/taxonomy-courses/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-tag">

                                        </i>
                                        <p>
                                            {{ trans('cruds.taxonomyCourse.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('taxonomy_course_type_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.taxonomy-course-types.index") }}" class="nav-link {{ request()->is("admin/taxonomy-course-types") || request()->is("admin/taxonomy-course-types/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-tag">

                                        </i>
                                        <p>
                                            {{ trans('cruds.taxonomyCourseType.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('taxonomy_address_type_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.taxonomy-address-types.index") }}" class="nav-link {{ request()->is("admin/taxonomy-address-types") || request()->is("admin/taxonomy-address-types/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-tag">

                                        </i>
                                        <p>
                                            {{ trans('cruds.taxonomyAddressType.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('taxonomy_phone_type_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.taxonomy-phone-types.index") }}" class="nav-link {{ request()->is("admin/taxonomy-phone-types") || request()->is("admin/taxonomy-phone-types/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-tag">

                                        </i>
                                        <p>
                                            {{ trans('cruds.taxonomyPhoneType.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('taxonomy_certification_type_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.taxonomy-certification-types.index") }}" class="nav-link {{ request()->is("admin/taxonomy-certification-types") || request()->is("admin/taxonomy-certification-types/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-tag">

                                        </i>
                                        <p>
                                            {{ trans('cruds.taxonomyCertificationType.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('taxonomy_credit_type_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.taxonomy-credit-types.index") }}" class="nav-link {{ request()->is("admin/taxonomy-credit-types") || request()->is("admin/taxonomy-credit-types/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-tag">

                                        </i>
                                        <p>
                                            {{ trans('cruds.taxonomyCreditType.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('taxonomy_discount_type_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.taxonomy-discount-types.index") }}" class="nav-link {{ request()->is("admin/taxonomy-discount-types") || request()->is("admin/taxonomy-discount-types/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-tag">

                                        </i>
                                        <p>
                                            {{ trans('cruds.taxonomyDiscountType.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('taxonomy_practice_type_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.taxonomy-practice-types.index") }}" class="nav-link {{ request()->is("admin/taxonomy-practice-types") || request()->is("admin/taxonomy-practice-types/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-tag">

                                        </i>
                                        <p>
                                            {{ trans('cruds.taxonomyPracticeType.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('taxonomy_media_type_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.taxonomy-media-types.index") }}" class="nav-link {{ request()->is("admin/taxonomy-media-types") || request()->is("admin/taxonomy-media-types/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-tag">

                                        </i>
                                        <p>
                                            {{ trans('cruds.taxonomyMediaType.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('taxonomy_media_provider_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.taxonomy-media-providers.index") }}" class="nav-link {{ request()->is("admin/taxonomy-media-providers") || request()->is("admin/taxonomy-media-providers/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-tag">

                                        </i>
                                        <p>
                                            {{ trans('cruds.taxonomyMediaProvider.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('taxonomy_media_delivery_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.taxonomy-media-deliveries.index") }}" class="nav-link {{ request()->is("admin/taxonomy-media-deliveries") || request()->is("admin/taxonomy-media-deliveries/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-tag">

                                        </i>
                                        <p>
                                            {{ trans('cruds.taxonomyMediaDelivery.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('taxonomy_arms_category_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.taxonomy-arms-categories.index") }}" class="nav-link {{ request()->is("admin/taxonomy-arms-categories") || request()->is("admin/taxonomy-arms-categories/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-tag">

                                        </i>
                                        <p>
                                            {{ trans('cruds.taxonomyArmsCategory.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('taxonomy_arms_code_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.taxonomy-arms-codes.index") }}" class="nav-link {{ request()->is("admin/taxonomy-arms-codes") || request()->is("admin/taxonomy-arms-codes/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-tag">

                                        </i>
                                        <p>
                                            {{ trans('cruds.taxonomyArmsCode.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('taxonomy_ad_service_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.taxonomy-ad-services.index") }}" class="nav-link {{ request()->is("admin/taxonomy-ad-services") || request()->is("admin/taxonomy-ad-services/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-tag">

                                        </i>
                                        <p>
                                            {{ trans('cruds.taxonomyAdService.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('taxonomy_profession_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.taxonomy-professions.index") }}" class="nav-link {{ request()->is("admin/taxonomy-professions") || request()->is("admin/taxonomy-professions/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-tag">

                                        </i>
                                        <p>
                                            {{ trans('cruds.taxonomyProfession.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('taxonomy_web_category_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.taxonomy-web-categories.index") }}" class="nav-link {{ request()->is("admin/taxonomy-web-categories") || request()->is("admin/taxonomy-web-categories/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-tag">

                                        </i>
                                        <p>
                                            {{ trans('cruds.taxonomyWebCategory.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('taxonomy_content_block_type_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.taxonomy-content-block-types.index") }}" class="nav-link {{ request()->is("admin/taxonomy-content-block-types") || request()->is("admin/taxonomy-content-block-types/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-tag">

                                        </i>
                                        <p>
                                            {{ trans('cruds.taxonomyContentBlockType.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('content_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/content-categories*") ? "menu-open" : "" }} {{ request()->is("admin/content-tags*") ? "menu-open" : "" }} {{ request()->is("admin/content-pages*") ? "menu-open" : "" }} {{ request()->is("admin/content-blocks*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-book">

                            </i>
                            <p>
                                {{ trans('cruds.contentManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('content_category_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.content-categories.index") }}" class="nav-link {{ request()->is("admin/content-categories") || request()->is("admin/content-categories/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-folder">

                                        </i>
                                        <p>
                                            {{ trans('cruds.contentCategory.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('content_tag_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.content-tags.index") }}" class="nav-link {{ request()->is("admin/content-tags") || request()->is("admin/content-tags/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-tags">

                                        </i>
                                        <p>
                                            {{ trans('cruds.contentTag.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('content_page_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.content-pages.index") }}" class="nav-link {{ request()->is("admin/content-pages") || request()->is("admin/content-pages/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-file">

                                        </i>
                                        <p>
                                            {{ trans('cruds.contentPage.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('content_block_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.content-blocks.index") }}" class="nav-link {{ request()->is("admin/content-blocks") || request()->is("admin/content-blocks/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-comment">

                                        </i>
                                        <p>
                                            {{ trans('cruds.contentBlock.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('slider_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/sliders*") ? "menu-open" : "" }} {{ request()->is("admin/slider-images*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-images">

                            </i>
                            <p>
                                {{ trans('cruds.sliderManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('slider_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.sliders.index") }}" class="nav-link {{ request()->is("admin/sliders") || request()->is("admin/sliders/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon far fa-images">

                                        </i>
                                        <p>
                                            {{ trans('cruds.slider.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('slider_image_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.slider-images.index") }}" class="nav-link {{ request()->is("admin/slider-images") || request()->is("admin/slider-images/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon far fa-image">

                                        </i>
                                        <p>
                                            {{ trans('cruds.sliderImage.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('testimonial_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/testimonial-types*") ? "menu-open" : "" }} {{ request()->is("admin/testimonials*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-comments">

                            </i>
                            <p>
                                {{ trans('cruds.testimonialManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('testimonial_type_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.testimonial-types.index") }}" class="nav-link {{ request()->is("admin/testimonial-types") || request()->is("admin/testimonial-types/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-tag">

                                        </i>
                                        <p>
                                            {{ trans('cruds.testimonialType.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('testimonial_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.testimonials.index") }}" class="nav-link {{ request()->is("admin/testimonials") || request()->is("admin/testimonials/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-comment">

                                        </i>
                                        <p>
                                            {{ trans('cruds.testimonial.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('faq_management_access')
                    <li class="nav-item has-treeview {{ request()->is("admin/faq-categories*") ? "menu-open" : "" }} {{ request()->is("admin/faq-questions*") ? "menu-open" : "" }}">
                        <a class="nav-link nav-dropdown-toggle" href="#">
                            <i class="fa-fw nav-icon fas fa-question">

                            </i>
                            <p>
                                {{ trans('cruds.faqManagement.title') }}
                                <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('faq_category_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.faq-categories.index") }}" class="nav-link {{ request()->is("admin/faq-categories") || request()->is("admin/faq-categories/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-briefcase">

                                        </i>
                                        <p>
                                            {{ trans('cruds.faqCategory.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                            @can('faq_question_access')
                                <li class="nav-item">
                                    <a href="{{ route("admin.faq-questions.index") }}" class="nav-link {{ request()->is("admin/faq-questions") || request()->is("admin/faq-questions/*") ? "active" : "" }}">
                                        <i class="fa-fw nav-icon fas fa-question">

                                        </i>
                                        <p>
                                            {{ trans('cruds.faqQuestion.title') }}
                                        </p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('structure_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.structures.index") }}" class="nav-link {{ request()->is("admin/structures") || request()->is("admin/structures/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-sitemap">

                            </i>
                            <p>
                                {{ trans('cruds.structure.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                @can('setting_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.settings.index") }}" class="nav-link {{ request()->is("admin/settings") || request()->is("admin/settings/*") ? "active" : "" }}">
                            <i class="fa-fw nav-icon fas fa-cogs">

                            </i>
                            <p>
                                {{ trans('cruds.setting.title') }}
                            </p>
                        </a>
                    </li>
                @endcan
                <li class="nav-item">
                    <a href="{{ route("admin.systemCalendar") }}" class="nav-link {{ request()->is("admin/system-calendar") || request()->is("admin/system-calendar/*") ? "active" : "" }}">
                        <i class="fas fa-fw fa-calendar nav-icon">

                        </i>
                        <p>
                            {{ trans('global.systemCalendar') }}
                        </p>
                    </a>
                </li>
                @php($unread = \App\Models\QaTopic::unreadCount())
                    <li class="nav-item">
                        <a href="{{ route("admin.messenger.index") }}" class="{{ request()->is("admin/messenger") || request()->is("admin/messenger/*") ? "active" : "" }} nav-link">
                            <i class="fa-fw fa fa-envelope nav-icon">

                            </i>
                            <p>{{ trans('global.messages') }}</p>
                            @if($unread > 0)
                                <strong>( {{ $unread }} )</strong>
                            @endif

                        </a>
                    </li>
                    @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                        @can('profile_password_edit')
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}" href="{{ route('profile.password.edit') }}">
                                    <i class="fa-fw fas fa-key nav-icon">
                                    </i>
                                    <p>
                                        {{ trans('global.change_password') }}
                                    </p>
                                </a>
                            </li>
                        @endcan
                    @endif
                    <li class="nav-item">
                        <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                            <p>
                                <i class="fas fa-fw fa-sign-out-alt nav-icon">

                                </i>
                                <p>{{ trans('global.logout') }}</p>
                            </p>
                        </a>
                    </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>