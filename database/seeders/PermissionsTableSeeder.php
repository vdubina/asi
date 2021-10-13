<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 18,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 19,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 20,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 21,
                'title' => 'faq_management_access',
            ],
            [
                'id'    => 22,
                'title' => 'faq_category_create',
            ],
            [
                'id'    => 23,
                'title' => 'faq_category_edit',
            ],
            [
                'id'    => 24,
                'title' => 'faq_category_show',
            ],
            [
                'id'    => 25,
                'title' => 'faq_category_delete',
            ],
            [
                'id'    => 26,
                'title' => 'faq_category_access',
            ],
            [
                'id'    => 27,
                'title' => 'faq_question_create',
            ],
            [
                'id'    => 28,
                'title' => 'faq_question_edit',
            ],
            [
                'id'    => 29,
                'title' => 'faq_question_show',
            ],
            [
                'id'    => 30,
                'title' => 'faq_question_delete',
            ],
            [
                'id'    => 31,
                'title' => 'faq_question_access',
            ],
            [
                'id'    => 32,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 33,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 34,
                'title' => 'taxonomy_course_create',
            ],
            [
                'id'    => 35,
                'title' => 'taxonomy_course_edit',
            ],
            [
                'id'    => 36,
                'title' => 'taxonomy_course_show',
            ],
            [
                'id'    => 37,
                'title' => 'taxonomy_course_delete',
            ],
            [
                'id'    => 38,
                'title' => 'taxonomy_course_access',
            ],
            [
                'id'    => 39,
                'title' => 'taxonomy_course_type_create',
            ],
            [
                'id'    => 40,
                'title' => 'taxonomy_course_type_edit',
            ],
            [
                'id'    => 41,
                'title' => 'taxonomy_course_type_show',
            ],
            [
                'id'    => 42,
                'title' => 'taxonomy_course_type_delete',
            ],
            [
                'id'    => 43,
                'title' => 'taxonomy_course_type_access',
            ],
            [
                'id'    => 44,
                'title' => 'taxonomy_address_type_create',
            ],
            [
                'id'    => 45,
                'title' => 'taxonomy_address_type_edit',
            ],
            [
                'id'    => 46,
                'title' => 'taxonomy_address_type_show',
            ],
            [
                'id'    => 47,
                'title' => 'taxonomy_address_type_delete',
            ],
            [
                'id'    => 48,
                'title' => 'taxonomy_address_type_access',
            ],
            [
                'id'    => 49,
                'title' => 'taxonomy_arms_category_create',
            ],
            [
                'id'    => 50,
                'title' => 'taxonomy_arms_category_edit',
            ],
            [
                'id'    => 51,
                'title' => 'taxonomy_arms_category_show',
            ],
            [
                'id'    => 52,
                'title' => 'taxonomy_arms_category_delete',
            ],
            [
                'id'    => 53,
                'title' => 'taxonomy_arms_category_access',
            ],
            [
                'id'    => 54,
                'title' => 'taxonomy_arms_code_create',
            ],
            [
                'id'    => 55,
                'title' => 'taxonomy_arms_code_edit',
            ],
            [
                'id'    => 56,
                'title' => 'taxonomy_arms_code_show',
            ],
            [
                'id'    => 57,
                'title' => 'taxonomy_arms_code_delete',
            ],
            [
                'id'    => 58,
                'title' => 'taxonomy_arms_code_access',
            ],
            [
                'id'    => 59,
                'title' => 'taxonomy_media_provider_create',
            ],
            [
                'id'    => 60,
                'title' => 'taxonomy_media_provider_edit',
            ],
            [
                'id'    => 61,
                'title' => 'taxonomy_media_provider_show',
            ],
            [
                'id'    => 62,
                'title' => 'taxonomy_media_provider_delete',
            ],
            [
                'id'    => 63,
                'title' => 'taxonomy_media_provider_access',
            ],
            [
                'id'    => 64,
                'title' => 'taxonomy_certification_type_create',
            ],
            [
                'id'    => 65,
                'title' => 'taxonomy_certification_type_edit',
            ],
            [
                'id'    => 66,
                'title' => 'taxonomy_certification_type_show',
            ],
            [
                'id'    => 67,
                'title' => 'taxonomy_certification_type_delete',
            ],
            [
                'id'    => 68,
                'title' => 'taxonomy_certification_type_access',
            ],
            [
                'id'    => 69,
                'title' => 'taxonomy_credit_type_create',
            ],
            [
                'id'    => 70,
                'title' => 'taxonomy_credit_type_edit',
            ],
            [
                'id'    => 71,
                'title' => 'taxonomy_credit_type_show',
            ],
            [
                'id'    => 72,
                'title' => 'taxonomy_credit_type_delete',
            ],
            [
                'id'    => 73,
                'title' => 'taxonomy_credit_type_access',
            ],
            [
                'id'    => 74,
                'title' => 'taxonomy_discount_type_create',
            ],
            [
                'id'    => 75,
                'title' => 'taxonomy_discount_type_edit',
            ],
            [
                'id'    => 76,
                'title' => 'taxonomy_discount_type_show',
            ],
            [
                'id'    => 77,
                'title' => 'taxonomy_discount_type_delete',
            ],
            [
                'id'    => 78,
                'title' => 'taxonomy_discount_type_access',
            ],
            [
                'id'    => 79,
                'title' => 'taxonomy_phone_type_create',
            ],
            [
                'id'    => 80,
                'title' => 'taxonomy_phone_type_edit',
            ],
            [
                'id'    => 81,
                'title' => 'taxonomy_phone_type_show',
            ],
            [
                'id'    => 82,
                'title' => 'taxonomy_phone_type_delete',
            ],
            [
                'id'    => 83,
                'title' => 'taxonomy_phone_type_access',
            ],
            [
                'id'    => 84,
                'title' => 'taxonomy_ad_service_create',
            ],
            [
                'id'    => 85,
                'title' => 'taxonomy_ad_service_edit',
            ],
            [
                'id'    => 86,
                'title' => 'taxonomy_ad_service_show',
            ],
            [
                'id'    => 87,
                'title' => 'taxonomy_ad_service_delete',
            ],
            [
                'id'    => 88,
                'title' => 'taxonomy_ad_service_access',
            ],
            [
                'id'    => 89,
                'title' => 'taxonomy_media_delivery_create',
            ],
            [
                'id'    => 90,
                'title' => 'taxonomy_media_delivery_edit',
            ],
            [
                'id'    => 91,
                'title' => 'taxonomy_media_delivery_show',
            ],
            [
                'id'    => 92,
                'title' => 'taxonomy_media_delivery_delete',
            ],
            [
                'id'    => 93,
                'title' => 'taxonomy_media_delivery_access',
            ],
            [
                'id'    => 94,
                'title' => 'taxonomy_media_type_create',
            ],
            [
                'id'    => 95,
                'title' => 'taxonomy_media_type_edit',
            ],
            [
                'id'    => 96,
                'title' => 'taxonomy_media_type_show',
            ],
            [
                'id'    => 97,
                'title' => 'taxonomy_media_type_delete',
            ],
            [
                'id'    => 98,
                'title' => 'taxonomy_media_type_access',
            ],
            [
                'id'    => 99,
                'title' => 'taxonomy_practice_type_create',
            ],
            [
                'id'    => 100,
                'title' => 'taxonomy_practice_type_edit',
            ],
            [
                'id'    => 101,
                'title' => 'taxonomy_practice_type_show',
            ],
            [
                'id'    => 102,
                'title' => 'taxonomy_practice_type_delete',
            ],
            [
                'id'    => 103,
                'title' => 'taxonomy_practice_type_access',
            ],
            [
                'id'    => 104,
                'title' => 'taxonomy_profession_create',
            ],
            [
                'id'    => 105,
                'title' => 'taxonomy_profession_edit',
            ],
            [
                'id'    => 106,
                'title' => 'taxonomy_profession_show',
            ],
            [
                'id'    => 107,
                'title' => 'taxonomy_profession_delete',
            ],
            [
                'id'    => 108,
                'title' => 'taxonomy_profession_access',
            ],
            [
                'id'    => 109,
                'title' => 'taxonomy_web_category_create',
            ],
            [
                'id'    => 110,
                'title' => 'taxonomy_web_category_edit',
            ],
            [
                'id'    => 111,
                'title' => 'taxonomy_web_category_show',
            ],
            [
                'id'    => 112,
                'title' => 'taxonomy_web_category_delete',
            ],
            [
                'id'    => 113,
                'title' => 'taxonomy_web_category_access',
            ],
            [
                'id'    => 114,
                'title' => 'testimonial_management_access',
            ],
            [
                'id'    => 115,
                'title' => 'testimonial_type_create',
            ],
            [
                'id'    => 116,
                'title' => 'testimonial_type_edit',
            ],
            [
                'id'    => 117,
                'title' => 'testimonial_type_show',
            ],
            [
                'id'    => 118,
                'title' => 'testimonial_type_delete',
            ],
            [
                'id'    => 119,
                'title' => 'testimonial_type_access',
            ],
            [
                'id'    => 120,
                'title' => 'testimonial_create',
            ],
            [
                'id'    => 121,
                'title' => 'testimonial_edit',
            ],
            [
                'id'    => 122,
                'title' => 'testimonial_show',
            ],
            [
                'id'    => 123,
                'title' => 'testimonial_delete',
            ],
            [
                'id'    => 124,
                'title' => 'testimonial_access',
            ],
            [
                'id'    => 125,
                'title' => 'slider_create',
            ],
            [
                'id'    => 126,
                'title' => 'slider_edit',
            ],
            [
                'id'    => 127,
                'title' => 'slider_show',
            ],
            [
                'id'    => 128,
                'title' => 'slider_delete',
            ],
            [
                'id'    => 129,
                'title' => 'slider_access',
            ],
            [
                'id'    => 130,
                'title' => 'slider_image_create',
            ],
            [
                'id'    => 131,
                'title' => 'slider_image_edit',
            ],
            [
                'id'    => 132,
                'title' => 'slider_image_show',
            ],
            [
                'id'    => 133,
                'title' => 'slider_image_delete',
            ],
            [
                'id'    => 134,
                'title' => 'slider_image_access',
            ],
            [
                'id'    => 135,
                'title' => 'course_topic_create',
            ],
            [
                'id'    => 136,
                'title' => 'course_topic_edit',
            ],
            [
                'id'    => 137,
                'title' => 'course_topic_show',
            ],
            [
                'id'    => 138,
                'title' => 'course_topic_delete',
            ],
            [
                'id'    => 139,
                'title' => 'course_topic_access',
            ],
            [
                'id'    => 140,
                'title' => 'course_product_create',
            ],
            [
                'id'    => 141,
                'title' => 'course_product_edit',
            ],
            [
                'id'    => 142,
                'title' => 'course_product_show',
            ],
            [
                'id'    => 143,
                'title' => 'course_product_delete',
            ],
            [
                'id'    => 144,
                'title' => 'course_product_access',
            ],
            [
                'id'    => 145,
                'title' => 'course_instructor_create',
            ],
            [
                'id'    => 146,
                'title' => 'course_instructor_edit',
            ],
            [
                'id'    => 147,
                'title' => 'course_instructor_show',
            ],
            [
                'id'    => 148,
                'title' => 'course_instructor_delete',
            ],
            [
                'id'    => 149,
                'title' => 'course_instructor_access',
            ],
            [
                'id'    => 150,
                'title' => 'content_management_access',
            ],
            [
                'id'    => 151,
                'title' => 'content_category_create',
            ],
            [
                'id'    => 152,
                'title' => 'content_category_edit',
            ],
            [
                'id'    => 153,
                'title' => 'content_category_show',
            ],
            [
                'id'    => 154,
                'title' => 'content_category_delete',
            ],
            [
                'id'    => 155,
                'title' => 'content_category_access',
            ],
            [
                'id'    => 156,
                'title' => 'content_tag_create',
            ],
            [
                'id'    => 157,
                'title' => 'content_tag_edit',
            ],
            [
                'id'    => 158,
                'title' => 'content_tag_show',
            ],
            [
                'id'    => 159,
                'title' => 'content_tag_delete',
            ],
            [
                'id'    => 160,
                'title' => 'content_tag_access',
            ],
            [
                'id'    => 161,
                'title' => 'content_page_create',
            ],
            [
                'id'    => 162,
                'title' => 'content_page_edit',
            ],
            [
                'id'    => 163,
                'title' => 'content_page_show',
            ],
            [
                'id'    => 164,
                'title' => 'content_page_delete',
            ],
            [
                'id'    => 165,
                'title' => 'content_page_access',
            ],
            [
                'id'    => 166,
                'title' => 'course_management_access',
            ],
            [
                'id'    => 167,
                'title' => 'slider_management_access',
            ],
            [
                'id'    => 168,
                'title' => 'taxonomy_management_access',
            ],
            [
                'id'    => 169,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
