<?php

use Illuminate\Database\Seeder;

class HelperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('nations')->insert([
            'name' => 'Việt Nam'
        ]);

        DB::table('nations')->insert([
            'name' => 'Hàn Quốc'
        ]);

        DB::table('nations')->insert([
            'name' => 'Không rõ'
        ]);

        DB::table('types')->insert([
            'name' => 'Nhạc trẻ'
        ]);

        DB::table('singers')->insert([
            'stage_name' => 'Thùy Chi',
            'name' => 'Trần Thùy Chi',
            'birthday' => '04/05/1990',
            'nation_id' => '1',
            'description' => 'Sinh năm 1990 - Hiện đang là học sinh khoa Piano - Nhạc viện Hà Nội Sở thích: Xem phim hoạt hình và nghe nhạcMàu sắc yêu thích : Đen - Trắng Sinh ra trong gia đình bố mẹ đều làm nghệ thuật nên từ nhỏ Thùy Chi đã được gia đình định hướng theo con đường nghệ thuật. Với niềm đam mê nghệ thuật và khả năng ca hát bẩm sinh nên Thùy Chi đã được nhiều khán giả trẻ yêu thích qua những ca khúc mà Chi đã thể hiện. Mặc dù đang sở hữu một giọng hát cao vút, truyền cảm nhưng mơ ước sau này của Thùy Chi lại là một giáo viên dạy đàn Piano - một ước mơ khá giản dị. Năm 2008 Thùy Chi nhận được giải ca sĩ được yêu thích nhất của chương trình Bài Hát Việt với những ca khúc như Thành Thị, Phố Cổ Tại lễ trao giải Làn Sóng Xanh 2009 vừa qua, Thùy Chi đã lần đầu tiên vinh dự được nhận giải 1 trong 10 ca sĩ được yêu thích nhất trong năm bên cạnh nhiều ngôi sao lớn khác. Không chỉ theo đuổi chuyên ngành piano, Thùy Chi còn hướng tới những bộ môn nghệ thuật khác như hát hợp xướng. Năm 2010, Thùy Chi cùng đoàn hợp xướng Việt Nam đã dành huy chương bạc hợp xướng thế giới và năm 2011, cô đã xuất sắc cùng đoàn Việt Nam dành huy chương vàng hợp xướng thế giới. Đây là một thành công lớn của hợp xướng Việt Nam, đánh dấu chặng đường phát triển đầy khó khăn và còn non trẻ nhưng đã gặt hái được những thành tích thật huy hoàng.',
        ]);

        DB::table('singers')->insert([
            'stage_name' => 'Anh Khang',
            'name' => 'Hoàng Anh Khang',
            'birthday' => '1989',
            'nation_id' => '1',
            'description' => '“Muốn làm từ A-Z trong âm nhạc”! - đó là lời khẳng định của chàng trai 20 tuổi, mà tôi dự đoán chính là nam ca sĩ cao nhất VN với chiều cao 1m84 và nặng 72kg. Thoạt nghe câu này có thể khiến người ta nghĩ về sự “ngông cuồng”, nhưng hoàn toàn khả thi khi biết anh đa tài, với lý lịch nghệ thuật không ít thành tích. Hoàng Anh Khang đã giành hai giải nhất toàn quốc về hát của lứa tuổi học trò, và là ca sĩ triển vọng của Công ty Music Faces (MFs). Đoàn biểu diễn xuyên Việt của MFs có mặt đầy đủ tại HN sáng nay. Họ ráp âm thanh ngay buổi chiều để tối 3/7, diễn tại nhà A3 Triển lãm Giảng Võ, chương trình Những gương mặt âm nhạc 2009. Đây là tour xuyên Việt đầu tiên trong đời nghệ thuật của Anh Khang.'
        ]);

        DB::table('singers')->insert([
            'stage_name' => 'Davichi',
            'name' => 'Davichi',
            'birthday' => '2008',
            'nation_id' => '2',
        ]);

        DB::table('singers')->insert([
            'stage_name' => 'Không rõ',
            'nation_id' => '3',
        ]);

        DB::table('singers')->insert([
            'stage_name' => 'Trịnh Thăng Bình',
            'nation_id' => '1',
        ]);

        DB::table('singers')->insert([
            'stage_name' => 'Minh Vương',
            'nation_id' => '1',
        ]);

        DB::table('singers')->insert([
            'stage_name' => 'Mai Tròn',
            'nation_id' => '1',
        ]);

        DB::table('singers')->insert([
            'stage_name' => 'Bích Phương',
            'nation_id' => '1',
        ]);

        DB::table('singers')->insert([
            'stage_name' => 'Phạm Hồng Phước',
            'nation_id' => '1',
        ]);

        DB::table('singers')->insert([
            'stage_name' => 'Phan Mạnh Quỳnh',
            'nation_id' => '1',
        ]);

        DB::table('singers')->insert([
            'stage_name' => 'Soobin Hoàng Sơn',
            'nation_id' => '1',
        ]);

        DB::table('singers')->insert([
            'stage_name' => 'Tiên Cookie',
            'nation_id' => '1',
        ]);

        DB::table('singers')->insert([
            'stage_name' => 'OnlyC',
            'nation_id' => '1',
        ]);

        DB::table('singers')->insert([
            'stage_name' => 'Lou Hoàng',
            'nation_id' => '1',
        ]);

        DB::table('singers')->insert([
            'stage_name' => 'Nguyên Jenda',
            'nation_id' => '1',
        ]);
    }
}
