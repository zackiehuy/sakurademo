<?php

namespace Database\Seeders;

use App\Models\ExecutiveBoard;
use App\Models\News;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('companies')->insert([
            [
                'name' => 'SAKURA ECOLOGY CO.,LTD',
                'default_logo' => '/img/logo_company/sakura.png'
            ],
            [
                'name' => 'TEAM 1000',
                'default_logo' => '/img/logo_company/team1000.png'
            ],
            [
                'name' => 'FUJI ONE',
                'default_logo' => '/img/logo_company/fujione.png'
            ]
        ]);

        DB::table('locations')->insert([
            [
                'name' => 'Hồ Chí Minh',
                'country' => 'Việt Nam'
            ],
            [
                'name' => 'Hà Nội',
                'country' => 'Việt Nam'
            ]
        ]);

        DB::table('branches')->insert([
            [
                'name' => 'WORK NOT WORK BUILDING FLOOR 3',
                'address' => '236/43/2 Dien Bien Phu, Ward 17 Binh Thanh District, Ho Chi Minh City.',
                'location_id' => '1',
                'phone' => '08294330938',
                'email' => 'sakura@gmail.com',
                'company_id' => '1',
            ],
            [
                'name' => 'HANOI BRANCH',
                'address' => 'No. 67, Lane 279 Doi Can Street, Ba Dinh District, Hanoi City.',
                'location_id' => '2',
                'phone' => '02432127610',
                'email' => 'sakura@gmail.com',
                'company_id' => '1',
            ]
        ]);
        DB::table('job_categories')->insert([
            [
                'name_en' => 'CEO',
                'name_vi' => 'CEO',
                'name_jp' => 'CEO'
            ],
            [
                'name_en' => 'Marketing Manager',
                'name_vi' => 'Giám đốc Marketing',
                'name_jp' => 'マーケティングマネージャー'
            ],
            [
                'name_en' => 'Accounting',
                'name_vi' => 'Kế toán',
                'name_jp' => 'アカウンティング'
            ],
            [
                'name_en' => 'Human Resource',
                'name_vi' => 'Nhân sự',
                'name_jp' => '人事労務管理'
            ],
            [
                'name_en' => 'CEO Assistant',
                'name_vi' => 'Trợ lý CEO',
                'name_jp' => 'CEOアシスタント'
            ],
            [
                'name_en' => 'Business Assistance',
                'name_vi' => 'Quản lý kinh doanh',
                'name_jp' => 'ビジネスアシスタント'
            ],
            [
                'name_en' => 'Regional Manager',
                'name_vi' => 'Quản lý khu vực',
                'name_jp' => '地域マネージャー'
            ],
            [
                'name_en' => 'Mechanical Sales',
                'name_vi' => 'Sale cơ khí',
                'name_jp' => '機械営業'
            ],
            [
                'name_en' => 'Editor',
                'name_vi' => 'Editor',
                'name_jp' => 'エディタ'
            ],
            [
                'name_en' => 'Deputy Service Manager',
                'name_vi' => 'Phó giám đốc dịch vụ',
                'name_jp' => '副サービスマネージャー'
            ],
            [
                'name_en' => 'Camera/Editor',
                'name_vi' => 'Nhiếp ảnh viên / Editor',
                'name_jp' => 'カメラ・エディタ'
            ],
            [
                'name_en' => 'Service Manager',
                'name_vi' => 'Quản lý dịch vụ',
                'name_jp' => 'サービスマネージャー'
            ],
        ]);
        $data = [
            [
                'job_category_id' => '1',
                'branch_id' => '1',
                'default_image' => 'img/executive_board/executive_1.png',
                'en' => ['name' => 'SAKAMOTO RYUTA'],
                'jp' => ['name' => '坂本 竜太'],
                'vi' => ['name' => ''],
            ],
            [
                'job_category_id' => '2',
                'branch_id' => '1',
                'default_image' => 'img/executive_board/executive_2.png',
                'en' => ['name' => 'TSUKAHARA MASAKI'],
                'jp' => ['name' => '塚原 匡貴'],
                'vi' => ['name' => ''],
            ],
            [
                'job_category_id' => '3',
                'branch_id' => '1',
                'default_image' => 'img/executive_board/executive_3.png',
                'en' => ['name' => 'Lê Thị Hồng Trinh'],
                'vi' => ['name' => 'Lê Thị Hồng Trinh'],
                'jp' => ['name' => ''],
            ],
            [
                'job_category_id' => '4',
                'branch_id' => '1',
                'default_image' => 'img/executive_board/executive_4.png',
                'en' => ['name' => 'Phạm Thị Kiều'],
                'vi' => ['name' => 'Phạm Thị Kiều'],
                'jp' => ['name' => ''],
            ],
            [
                'job_category_id' => '5',
                'branch_id' => '1',
                'default_image' => 'img/executive_board/executive_5.png',
                'en' => ['name' => 'Hồ Thị Thanh'],
                'vi' => ['name' => 'Hồ Thị Thanh'],
                'jp' => ['name' => ''],
            ],
            [
                'job_category_id' => '6',
                'branch_id' => '1',
                'default_image' => 'img/executive_board/executive_6.png',
                'en' => ['name' => 'Nguyễn Thị Mỹ Xinh'],
                'vi' => ['name' => 'Nguyễn Thị Mỹ Xinh'],
                'jp' => ['name' => ''],
            ],
            [
                'job_category_id' => '7',
                'branch_id' => '1',
                'default_image' => 'img/executive_board/executive_7.png',
                'en' => ['name' => 'Phạm Nhất Duy'],
                'vi' => ['name' => 'Phạm Nhất Duy'],
                'jp' => ['name' => ''],
            ],
            [
                'job_category_id' => '8',
                'branch_id' => '1',
                'default_image' => 'img/executive_board/executive_8.png',
                'en' => ['name' => 'Đỗ Văn Thanh'],
                'vi' => ['name' => 'Đỗ Văn Thanh'],
                'jp' => ['name' => ''],
            ],
            [
                'job_category_id' => '9',
                'branch_id' => '1',
                'default_image' => 'img/executive_board/executive_9.png',
                'en' => ['name' => 'Lương Tuấn Anh'],
                'vi' => ['name' => 'Lương Tuấn Anh'],
                'jp' => ['name' => ''],
            ],
            [
                'job_category_id' => '10',
                'branch_id' => '1',
                'default_image' => 'img/executive_board/executive_10.png',
                'en' => ['name' => 'Nguyễn hữu hoàng sơn'],
                'vi' => ['name' => 'Nguyễn hữu hoàng sơn'],
                'jp' => ['name' => ''],
            ],
            [
                'job_category_id' => '11',
                'branch_id' => '1',
                'default_image' => 'img/executive_board/executive_11.png',
                'en' => ['name' => 'Trần hoàng vũ'],
                'vi' => ['name' => 'Trần hoàng vũ'],
                'jp' => ['name' => ''],
            ],
            [
                'job_category_id' => '12',
                'branch_id' => '2',
                'default_image' => 'img/executive_board/executive_12.png',
                'en' => ['name' => 'Hoàng Ngọc Hiệp'],
                'vi' => ['name' => 'Hoàng Ngọc Hiệp'],
                'jp' => ['name' => ''],
            ],
            [
                'job_category_id' => '4',
                'branch_id' => '2',
                'default_image' => 'img/executive_board/executive_13.png',
                'en' => ['name' => 'Hoàng Bích Huệ'],
                'vi' => ['name' => 'Hoàng Bích Huệ'],
                'jp' => ['name' => ''],
            ]
        ];
        foreach ($data as $value) {
            ExecutiveBoard::create($value);
        }
        DB::table('wines')->insert([
            [
                'name' => 'Shunnoten Harunoyoi',
                'code' => 'A1',
                'default_image' => 'img/wine/wine_1.png',
                'is_new' => 0
            ],
            [
                'name' => 'Yamaki shuzou Kaiotokoyama',
                'code' => 'A2',
                'default_image' => 'img/wine/wine_2.png',
                'is_new' => 0
            ],
            [
                'name' => 'Sasaichi shuzou Sasaichi',
                'code' => 'A3',
                'default_image' => 'img/wine/wine_3.png',
                'is_new' => 0
            ],
            [
                'name' => 'Tanizakura shuzou Tanizakura',
                'code' => 'A4',
                'default_image' => 'img/wine/wine_4.png',
                'is_new' => 0
            ],
            [
                'name' => 'Shichiken Sparkling',
                'code' => 'A5',
                'default_image' => 'img/wine/wine_8.png',
                'is_new' => 0
            ],
            [
                'name' => 'Shichiken Shichiken',
                'code' => 'A6',
                'default_image' => 'img/wine/wine_5.png',
                'is_new' => 0
            ],
            [
                'name' => 'Kainokaiun Ginjo',
                'code' => 'A7',
                'default_image' => 'img/wine/wine_6.png',
                'is_new' => 0
            ],
            [
                'name' => 'Tanizakura shuzou Kainohana',
                'code' => 'A8',
                'default_image' => 'img/wine/wine_7.png',
                'is_new' => 0
            ],
            [
                'name' => '',
                'code' => 'A9',
                'default_image' => '',
                'is_new' => 1
            ],
            [
                'name' => '',
                'code' => 'A10',
                'default_image' => '',
                'is_new' => 1
            ],
            [
                'name' => '',
                'code' => 'A11',
                'default_image' => '',
                'is_new' => 1
            ],
        ]);
        $data_news = [
            [
                'default_image' => 'img/news/news_1.png',
                'en' => [
                    'title' => 'TOPVALU video product',
                    'abstract' => '“ Jelly drink “ which is very famous in Japan has now come to Vietnam.
The promotional video we are producing is shown on the monitor inside AEON MALL.'
                ],
                'jp' => [
                    'title' => 'TOPVALUの商品映像',
                    'abstract' => '日本でも大人気の「ドリンクゼリー」がベトナムに上陸。
私たちが制作している宣伝映像は、イオンモール内のモニターに流れています。'
                ],
                'vi' => [
                    'title' => 'Video sản phẩm TOPVALU',
                    'abstract' => '"Thạch uống" vốn rất nổi tiếng tại Nhật Bản nay đã đến vào Việt Nam.
Video quảng cáo chúng tôi đang sản xuất được chiếu trên màn hình bên trong AEON MALL.'
                ],
            ],
            [
                'default_image' => 'img/news/news_2.png',
                'en' => [
                    'title' => 'Start the maintenance job at Midori Park town area in Binh Duong province.',
                    'abstract' => 'This is top-rated Vietnamese and foreigner attractions.
Strive for maintenance service excellence.'
                ],
                'jp' => [
                    'title' => 'ビンズン省「MIDORI PARK」メンテナンススタート',
                    'abstract' => 'ベトナム人・外国人にとって、いま注目の場所です。
清掃メンテナンスをがんばります。'
                ],
                'vi' => [
                    'title' => 'Bắt đầu công việc bảo trì tại tỉnh Bình Dương công trình "MIDORI PARK"',
                    'abstract' => 'Đây sẽ là điểm thu hút người Việt Nam và người nước ngoài.
Phấn đấu trong công việc bảo trì'
                ],
            ],
            [
                'default_image' => 'img/news/news_3.png',
                'en' => [
                    'title' => 'Decorate new flag for the company.',
                    'abstract' => 'Memorize the friendship between Vietnam and Japan!
Vietnam and Japan staff “ laugh together and move forward together”'
                ],
                'jp' => [
                    'title' => '会社に新しい国旗を購入',
                    'abstract' => 'ベトナム・日本の友好！
ベトナム人スタッフ・日本人スタッフ「共に笑い、共に前進」します。'
                ],
                'vi' => [
                    'title' => 'Trang trí lá cờ mới cho công ty',
                    'abstract' => 'Ghi nhớ tình hữu nghị giữa Việt Nam và Nhật Bản!
Nhân viên Việt Nam và nhân viên Nhật Bản “cùng nhau cười, cùng nhau tiến về phía trước”.'
                ],
            ]
        ];
        foreach ($data_news as $value) {
            News::create($value);
        }
        DB::table('settings')->insert([
            [
                'name' => config('app.name'),
                'founded_date' => Carbon::parse('2007-12-01'),
                'charter_capital' => '4369500000',
                'cost' => 'vnd',
                'legal_representative' => 'Sakamoto Ryuta',
                'mail_username' => config('app.mail_username'),
                'mail_password' => config('app.mail_password'),
                'main_business_activities' => '<div class="child-detail-1">
                                                    <p>Real Estate Management</p>
                                                    <p>Building Equipment Management</p>
                                                </div>
                                                <div class="child-detail-2">
                                                    <p>Home Cleaning</p>
                                                    <p>Specialized Cleaning</p>
                                                    <p>Import And Export (Excluding The Establishment Of Retail Locations)</p>
                                                    <p>Marketing , Human Resources , Production Management Consulting</p>
                                                    <p>Graphic Design (Excluding Advertising Services)</p>
                                                </div>
                                                <div class="child-detail-1 child-detail-special ">
                                                    <p>Homepage Design (Excluding Advertising Service)</p>
                                                    <p class="sub-special">Processing Data And Running Programs (Movies)</p>
                                                </div>'
            ],
        ]);
        DB::table('hotlines')->insert([
            [
                'name' => 'TSUKAHARA MASAKI',
                'is_male' => true,
                'phone' => '0932105081',
                'branch_id' => '1',
            ],
            [
                'name' => 'HOANG NGOC HIEP',
                'is_male' => true,
                'phone' => '0964303881',
                'branch_id' => '1',
            ],
            [
                'name' => 'TSUKAHARA MASAKI',
                'is_male' => true,
                'phone' => '0932105081',
                'branch_id' => '2',
            ],
            [
                'name' => 'NGUYEN THI MY XINH',
                'is_male' => false,
                'phone' => '0947122029',
                'branch_id' => '2',
            ],
        ]);
    }
}
