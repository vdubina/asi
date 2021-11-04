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
                'title' => 'taxonomy_course_create',
            ],
            [
                'id'    => 33,
                'title' => 'taxonomy_course_edit',
            ],
            [
                'id'    => 34,
                'title' => 'taxonomy_course_show',
            ],
            [
                'id'    => 35,
                'title' => 'taxonomy_course_delete',
            ],
            [
                'id'    => 36,
                'title' => 'taxonomy_course_access',
            ],
            [
                'id'    => 37,
                'title' => 'taxonomy_course_type_create',
            ],
            [
                'id'    => 38,
                'title' => 'taxonomy_course_type_edit',
            ],
            [
                'id'    => 39,
                'title' => 'taxonomy_course_type_show',
            ],
            [
                'id'    => 40,
                'title' => 'taxonomy_course_type_delete',
            ],
            [
                'id'    => 41,
                'title' => 'taxonomy_course_type_access',
            ],
            [
                'id'    => 42,
                'title' => 'taxonomy_address_type_create',
            ],
            [
                'id'    => 43,
                'title' => 'taxonomy_address_type_edit',
            ],
            [
                'id'    => 44,
                'title' => 'taxonomy_address_type_show',
            ],
            [
                'id'    => 45,
                'title' => 'taxonomy_address_type_delete',
            ],
            [
                'id'    => 46,
                'title' => 'taxonomy_address_type_access',
            ],
            [
                'id'    => 47,
                'title' => 'taxonomy_arms_category_create',
            ],
            [
                'id'    => 48,
                'title' => 'taxonomy_arms_category_edit',
            ],
            [
                'id'    => 49,
                'title' => 'taxonomy_arms_category_show',
            ],
            [
                'id'    => 50,
                'title' => 'taxonomy_arms_category_delete',
            ],
            [
                'id'    => 51,
                'title' => 'taxonomy_arms_category_access',
            ],
            [
                'id'    => 52,
                'title' => 'taxonomy_arms_code_create',
            ],
            [
                'id'    => 53,
                'title' => 'taxonomy_arms_code_edit',
            ],
            [
                'id'    => 54,
                'title' => 'taxonomy_arms_code_show',
            ],
            [
                'id'    => 55,
                'title' => 'taxonomy_arms_code_delete',
            ],
            [
                'id'    => 56,
                'title' => 'taxonomy_arms_code_access',
            ],
            [
                'id'    => 57,
                'title' => 'taxonomy_media_provider_create',
            ],
            [
                'id'    => 58,
                'title' => 'taxonomy_media_provider_edit',
            ],
            [
                'id'    => 59,
                'title' => 'taxonomy_media_provider_show',
            ],
            [
                'id'    => 60,
                'title' => 'taxonomy_media_provider_delete',
            ],
            [
                'id'    => 61,
                'title' => 'taxonomy_media_provider_access',
            ],
            [
                'id'    => 62,
                'title' => 'taxonomy_certification_type_create',
            ],
            [
                'id'    => 63,
                'title' => 'taxonomy_certification_type_edit',
            ],
            [
                'id'    => 64,
                'title' => 'taxonomy_certification_type_show',
            ],
            [
                'id'    => 65,
                'title' => 'taxonomy_certification_type_delete',
            ],
            [
                'id'    => 66,
                'title' => 'taxonomy_certification_type_access',
            ],
            [
                'id'    => 67,
                'title' => 'taxonomy_credit_type_create',
            ],
            [
                'id'    => 68,
                'title' => 'taxonomy_credit_type_edit',
            ],
            [
                'id'    => 69,
                'title' => 'taxonomy_credit_type_show',
            ],
            [
                'id'    => 70,
                'title' => 'taxonomy_credit_type_delete',
            ],
            [
                'id'    => 71,
                'title' => 'taxonomy_credit_type_access',
            ],
            [
                'id'    => 72,
                'title' => 'taxonomy_discount_type_create',
            ],
            [
                'id'    => 73,
                'title' => 'taxonomy_discount_type_edit',
            ],
            [
                'id'    => 74,
                'title' => 'taxonomy_discount_type_show',
            ],
            [
                'id'    => 75,
                'title' => 'taxonomy_discount_type_delete',
            ],
            [
                'id'    => 76,
                'title' => 'taxonomy_discount_type_access',
            ],
            [
                'id'    => 77,
                'title' => 'taxonomy_phone_type_create',
            ],
            [
                'id'    => 78,
                'title' => 'taxonomy_phone_type_edit',
            ],
            [
                'id'    => 79,
                'title' => 'taxonomy_phone_type_show',
            ],
            [
                'id'    => 80,
                'title' => 'taxonomy_phone_type_delete',
            ],
            [
                'id'    => 81,
                'title' => 'taxonomy_phone_type_access',
            ],
            [
                'id'    => 82,
                'title' => 'taxonomy_ad_service_create',
            ],
            [
                'id'    => 83,
                'title' => 'taxonomy_ad_service_edit',
            ],
            [
                'id'    => 84,
                'title' => 'taxonomy_ad_service_show',
            ],
            [
                'id'    => 85,
                'title' => 'taxonomy_ad_service_delete',
            ],
            [
                'id'    => 86,
                'title' => 'taxonomy_ad_service_access',
            ],
            [
                'id'    => 87,
                'title' => 'taxonomy_media_delivery_create',
            ],
            [
                'id'    => 88,
                'title' => 'taxonomy_media_delivery_edit',
            ],
            [
                'id'    => 89,
                'title' => 'taxonomy_media_delivery_show',
            ],
            [
                'id'    => 90,
                'title' => 'taxonomy_media_delivery_delete',
            ],
            [
                'id'    => 91,
                'title' => 'taxonomy_media_delivery_access',
            ],
            [
                'id'    => 92,
                'title' => 'taxonomy_media_type_create',
            ],
            [
                'id'    => 93,
                'title' => 'taxonomy_media_type_edit',
            ],
            [
                'id'    => 94,
                'title' => 'taxonomy_media_type_show',
            ],
            [
                'id'    => 95,
                'title' => 'taxonomy_media_type_delete',
            ],
            [
                'id'    => 96,
                'title' => 'taxonomy_media_type_access',
            ],
            [
                'id'    => 97,
                'title' => 'taxonomy_practice_type_create',
            ],
            [
                'id'    => 98,
                'title' => 'taxonomy_practice_type_edit',
            ],
            [
                'id'    => 99,
                'title' => 'taxonomy_practice_type_show',
            ],
            [
                'id'    => 100,
                'title' => 'taxonomy_practice_type_delete',
            ],
            [
                'id'    => 101,
                'title' => 'taxonomy_practice_type_access',
            ],
            [
                'id'    => 102,
                'title' => 'taxonomy_profession_create',
            ],
            [
                'id'    => 103,
                'title' => 'taxonomy_profession_edit',
            ],
            [
                'id'    => 104,
                'title' => 'taxonomy_profession_show',
            ],
            [
                'id'    => 105,
                'title' => 'taxonomy_profession_delete',
            ],
            [
                'id'    => 106,
                'title' => 'taxonomy_profession_access',
            ],
            [
                'id'    => 107,
                'title' => 'taxonomy_web_category_create',
            ],
            [
                'id'    => 108,
                'title' => 'taxonomy_web_category_edit',
            ],
            [
                'id'    => 109,
                'title' => 'taxonomy_web_category_show',
            ],
            [
                'id'    => 110,
                'title' => 'taxonomy_web_category_delete',
            ],
            [
                'id'    => 111,
                'title' => 'taxonomy_web_category_access',
            ],
            [
                'id'    => 112,
                'title' => 'testimonial_management_access',
            ],
            [
                'id'    => 113,
                'title' => 'testimonial_type_create',
            ],
            [
                'id'    => 114,
                'title' => 'testimonial_type_edit',
            ],
            [
                'id'    => 115,
                'title' => 'testimonial_type_show',
            ],
            [
                'id'    => 116,
                'title' => 'testimonial_type_delete',
            ],
            [
                'id'    => 117,
                'title' => 'testimonial_type_access',
            ],
            [
                'id'    => 118,
                'title' => 'testimonial_create',
            ],
            [
                'id'    => 119,
                'title' => 'testimonial_edit',
            ],
            [
                'id'    => 120,
                'title' => 'testimonial_show',
            ],
            [
                'id'    => 121,
                'title' => 'testimonial_delete',
            ],
            [
                'id'    => 122,
                'title' => 'testimonial_access',
            ],
            [
                'id'    => 123,
                'title' => 'slider_create',
            ],
            [
                'id'    => 124,
                'title' => 'slider_edit',
            ],
            [
                'id'    => 125,
                'title' => 'slider_show',
            ],
            [
                'id'    => 126,
                'title' => 'slider_delete',
            ],
            [
                'id'    => 127,
                'title' => 'slider_access',
            ],
            [
                'id'    => 128,
                'title' => 'slider_image_create',
            ],
            [
                'id'    => 129,
                'title' => 'slider_image_edit',
            ],
            [
                'id'    => 130,
                'title' => 'slider_image_show',
            ],
            [
                'id'    => 131,
                'title' => 'slider_image_delete',
            ],
            [
                'id'    => 132,
                'title' => 'slider_image_access',
            ],
            [
                'id'    => 133,
                'title' => 'course_topic_create',
            ],
            [
                'id'    => 134,
                'title' => 'course_topic_edit',
            ],
            [
                'id'    => 135,
                'title' => 'course_topic_show',
            ],
            [
                'id'    => 136,
                'title' => 'course_topic_delete',
            ],
            [
                'id'    => 137,
                'title' => 'course_topic_access',
            ],
            [
                'id'    => 138,
                'title' => 'course_product_create',
            ],
            [
                'id'    => 139,
                'title' => 'course_product_edit',
            ],
            [
                'id'    => 140,
                'title' => 'course_product_show',
            ],
            [
                'id'    => 141,
                'title' => 'course_product_delete',
            ],
            [
                'id'    => 142,
                'title' => 'course_product_access',
            ],
            [
                'id'    => 143,
                'title' => 'course_instructor_create',
            ],
            [
                'id'    => 144,
                'title' => 'course_instructor_edit',
            ],
            [
                'id'    => 145,
                'title' => 'course_instructor_show',
            ],
            [
                'id'    => 146,
                'title' => 'course_instructor_delete',
            ],
            [
                'id'    => 147,
                'title' => 'course_instructor_access',
            ],
            [
                'id'    => 148,
                'title' => 'content_management_access',
            ],
            [
                'id'    => 149,
                'title' => 'content_category_create',
            ],
            [
                'id'    => 150,
                'title' => 'content_category_edit',
            ],
            [
                'id'    => 151,
                'title' => 'content_category_show',
            ],
            [
                'id'    => 152,
                'title' => 'content_category_delete',
            ],
            [
                'id'    => 153,
                'title' => 'content_category_access',
            ],
            [
                'id'    => 154,
                'title' => 'content_tag_create',
            ],
            [
                'id'    => 155,
                'title' => 'content_tag_edit',
            ],
            [
                'id'    => 156,
                'title' => 'content_tag_show',
            ],
            [
                'id'    => 157,
                'title' => 'content_tag_delete',
            ],
            [
                'id'    => 158,
                'title' => 'content_tag_access',
            ],
            [
                'id'    => 159,
                'title' => 'content_page_create',
            ],
            [
                'id'    => 160,
                'title' => 'content_page_edit',
            ],
            [
                'id'    => 161,
                'title' => 'content_page_show',
            ],
            [
                'id'    => 162,
                'title' => 'content_page_delete',
            ],
            [
                'id'    => 163,
                'title' => 'content_page_access',
            ],
            [
                'id'    => 164,
                'title' => 'course_management_access',
            ],
            [
                'id'    => 165,
                'title' => 'slider_management_access',
            ],
            [
                'id'    => 166,
                'title' => 'taxonomy_management_access',
            ],
            [
                'id'    => 167,
                'title' => 'structure_create',
            ],
            [
                'id'    => 168,
                'title' => 'structure_edit',
            ],
            [
                'id'    => 169,
                'title' => 'structure_show',
            ],
            [
                'id'    => 170,
                'title' => 'structure_delete',
            ],
            [
                'id'    => 171,
                'title' => 'structure_access',
            ],
            [
                'id'    => 172,
                'title' => 'content_block_create',
            ],
            [
                'id'    => 173,
                'title' => 'content_block_edit',
            ],
            [
                'id'    => 174,
                'title' => 'content_block_show',
            ],
            [
                'id'    => 175,
                'title' => 'content_block_delete',
            ],
            [
                'id'    => 176,
                'title' => 'content_block_access',
            ],
            [
                'id'    => 177,
                'title' => 'taxonomy_content_block_type_create',
            ],
            [
                'id'    => 178,
                'title' => 'taxonomy_content_block_type_edit',
            ],
            [
                'id'    => 179,
                'title' => 'taxonomy_content_block_type_show',
            ],
            [
                'id'    => 180,
                'title' => 'taxonomy_content_block_type_delete',
            ],
            [
                'id'    => 181,
                'title' => 'taxonomy_content_block_type_access',
            ],
            [
                'id'    => 182,
                'title' => 'course_coupon_create',
            ],
            [
                'id'    => 183,
                'title' => 'course_coupon_edit',
            ],
            [
                'id'    => 184,
                'title' => 'course_coupon_show',
            ],
            [
                'id'    => 185,
                'title' => 'course_coupon_delete',
            ],
            [
                'id'    => 186,
                'title' => 'course_coupon_access',
            ],
            [
                'id'    => 187,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
