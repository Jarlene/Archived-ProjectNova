-- Sample Data Insertion(withdatabase reseting)
-- Version: V0613
-- Author: Phoenix

CREATE DATABASE if not exists nova;
ALTER DATABASE nova CHARACTER SET utf8;

use nova;

-- RESETING TABLES
DROP TABLE if exists CMTAuthors cascade;
DROP TABLE if exists CMTBooks cascade;
DROP TABLE if exists FAVAuthors cascade;
DROP TABLE if exists FAVBooks cascade;
DROP TABLE if exists HSAuthors cascade;
DROP TABLE if exists HSBooks cascade;
DROP TABLE if exists Members cascade;
DROP TABLE if exists Links cascade;
DROP TABLE if exists BookDetails cascade;
DROP TABLE if exists Books cascade;
DROP TABLE if exists GenreDetails cascade;
DROP TABLE if exists Genres cascade;
DROP TABLE if exists AuthorDetails cascade;
DROP TABLE if exists Authors cascade;
DROP TABLE if exists CountryDetails cascade;
DROP TABLE if exists Countries cascade;
DROP TABLE if exists Languages cascade;

CREATE TABLE Languages(
    LCode char(5) primary key,
    LName varchar(100) not null,
    HomePage TEXT
);

CREATE TABLE Authors(
    AID varchar(100) not null,
    LCode char(5) not null,
    AName varchar(200) not null,
    ADesc TEXT,
    primary key(AID,LCode),
    FOREIGN KEY(LCode) REFERENCES Languages(LCode) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE Genres(
    GCode varchar(10) not null,
    LCode char(5) not null,
    GName varchar(200) not null,
    GLink TEXT,
    primary key(GCode,LCode),
    FOREIGN KEY(LCode) REFERENCES Languages(LCode) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE Books(
    BID varchar(100) primary key,
    AID varchar(100) not null,
    GCode varchar(10) not null,
    ORelease DATE default 0,
    Clicks INT UNSIGNED default 0,
    Rating INT UNSIGNED default NULL,
    FOREIGN KEY(AID) REFERENCES Authors(AID) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY(GCode) REFERENCES Genres(GCode) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE BookDetails(
    BID varchar(100) not null,
    LCode char(5) not null,
    BName TEXT not null,
    BRelease DATE not null default 0,
    WCount INT default NULL,
    BUpdate DATE not null default 0,
    BDesc TEXT,
    primary key(BID,LCode),
    FOREIGN KEY(BID) REFERENCES Books(BID) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY(LCode) REFERENCES Languages(LCode) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE Links(
    URL TEXT not null,
    LType TEXT not null,
    BID varchar(100) not null,
    LCode char(5) not null,
    LChecksum INT unsigned not null,
    primary key(LChecksum, BID, LCode),
    FOREIGN KEY(BID) REFERENCES Books(BID) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY(LCode) REFERENCES Languages(LCode) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE Members(
    UserName varchar(20) primary key,
    UserPass char(40) not null, -- Encrypt the password in SHA1, no actual password stored
    LangPref char(5) default 'eng',
    SectionID char(40),
    FOREIGN KEY(LangPref) REFERENCES Languages(LCode) ON UPDATE CASCADE ON DELETE SET NULL
);

CREATE TABLE HSBooks(
    UserName varchar(20) not null,
    BID varchar(100) not null,
    LastVisit DATETIME not null,
    primary key(UserName, BID),
    FOREIGN KEY(UserName) REFERENCES Members(UserName) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY(BID) REFERENCES Books(BID) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE HSAuthors(
    UserName varchar(20) not null,
    AID varchar(100) not null,
    LastVisit DATETIME not null,
    primary key(UserName, AID),
    FOREIGN KEY(UserName) REFERENCES Members(UserName) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY(AID) REFERENCES Authors(AID) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE FAVBooks(
    UserName varchar(20) not null,
    BID varchar(100) not null,
    AddedAt DATE not null,
    primary key(UserName, BID),
    FOREIGN KEY(UserName) REFERENCES Members(UserName) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY(BID) REFERENCES Books(BID) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE FAVAuthors(
    UserName varchar(20) not null,
    AID varchar(100) not null,
    AddedAt DATE not null,
    primary key(UserName, AID),
    FOREIGN KEY(UserName) REFERENCES Members(UserName) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY(AID) REFERENCES Authors(AID) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE CMTBooks(
	CMTID int not null auto_increment primary key,
    TStamp timestamp not null,
    BID varchar(100) not null,
    Content TEXT not null,
    FOREIGN KEY(BID) REFERENCES Books(BID) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE CMTAuthors(
	CMTID int not null auto_increment primary key,
    TStamp timestamp not null,
    AID varchar(100) not null,
    Content TEXT not null,
    FOREIGN KEY(AID) REFERENCES Authors(AID) ON UPDATE CASCADE ON DELETE CASCADE
);
-- END OF TABLE RESETTING


--
-- Sample data insertion
--

-- Language Table (Language Code Refers to ISO 639-3 Code
--                  https://en.wikipedia.org/wiki/List_of_ISO_639-2_codes)
insert into Languages values( 'eng','English', 'http://localhost/eng/');
insert into Languages values( 'jpn','日本語', 'http://localhost/jpn/');
insert into Languages values( 'zho','中文', 'http://localhost/zho/');

-- Authors Table
-- 
insert into Authors values( 'Nagatsuki_Tappei','eng', 'Tappei Nagatsuki', 'Tappei Nagatsuki is the author of the light novel series RE:Zero.');
insert into Authors values( 'Nagatsuki_Tappei','jpn', '鼠色猫/長月達平', '鼠色猫/長月達平とは、大手小説投稿サイト『小説家になろう』出身のライトノベル作家である。代表作は『Ｒｅ：ゼロから始める異世界生活』。');
insert into Authors values( 'Nagatsuki_Tappei','zho', '长月达平', '长月达平（1987年3月11日[1]  -），是日本男性小说家，轻小说作家。 原本是笔名为鼠色猫的网路电子小说投稿网站「成为小说家吧」作家，《Re:从零开始的异世界生活》为其第一本实体化小说。2016年2月11日，应台湾青文出版社邀请，参加第4届台北国际动漫节并举办签名会。');

insert into Authors values( 'Liu_Cixin','eng', 'Cixin Liu', "Liu Cixin (simplified Chinese: 刘慈欣; traditional Chinese: 劉慈欣, IPA: [li̯ǒu̯ tsʰɨ̌ɕín]; born 1963) is a Chinese science fiction writer.[1] He is a nine-time winner of the Galaxy Award (China's most prestigious literary science fiction award) and winner of The Hugo Award.[2] Liu's work is considered hard science fiction. In English translations of his works, his name is given in the form Cixin Liu.");
insert into Authors values( 'Liu_Cixin','jpn', '劉慈欣', '劉慈欣（りゅう じきん、1968年[1] - ）は、中華人民共和国のSF作家。山西省陽泉出身[2]。本業はエンジニアで、発電所のコンピュータ管理を担当している。
中学生のころから創作を開始。1999年、中国のSF雑誌『科幻世界』（zh）でデビュー。その後、銀河賞（zh）に連続して入選。2010年、第1回中国星雲賞（世界華人SF協会主催）で作家賞を受賞（韓松と同時受賞）。
SFに興味を持つきっかけになったのはジュール・ヴェルヌ『地底旅行』で、その後アーサー・C・クラークの『2001年宇宙の旅』で本格的にSFにのめり込むようになった。
公刊された日本語訳には、2001年に第12回銀河賞特等賞を受賞した短編「さまよえる地球」（S-Fマガジン掲載）がある。');
insert into Authors values( 'Liu_Cixin','zho', '刘慈欣','刘慈欣（1963年6月23日－），中国当代科幻作家，自1980年代中期开始创作，1999年6月起在《科幻世界》杂志上发表多篇科幻小说和科幻随笔，并出版了多部长篇科幻小说，现为中国科普作家协会会员，山西省作家协会会员，阳泉市作协副主席。其代表作有长篇小说《超新星纪元》、《球状闪电》、《三体》、《三体II：黑暗森林》、《三体III：死神永生》，中短篇小说《流浪地球》、《乡村教师》、《朝闻道》等。刘慈欣目前是中国最有影响力的本土科幻作家之一。');

insert into Authors values( 'Gatoh_Shoji','eng', 'Shoji Gatoh', 'Shoji Gato (賀東 招二 Gatō Shōji?, born July 11, 1971 (age 44)),[1] is a Japanese author from Shiga Prefecture, Japan. He is best known for the creation of the Full Metal Panic! series that included light novels, manga and anime. He is not only an author but also an anime scenarist, for example "The Day of Sagittarius" of The Melancholy of Haruhi Suzumiya and three episodes of Lucky Star.
Shoji Gato met with Koichi Chigira by accident when he bumped into him in Shinjuku when he was late for work. Later on, the two were shocked to meet with one another in the Gonzo Digimation office. The two later teamed up to create the Full Metal Panic! anime series.[1]');
insert into Authors values( 'Gatoh_Shoji','jpn', '賀東招二', '大学在籍中にとあるライトノベルを読み、「これだったら俺にも書ける」と思い、ゲーム制作会社「遊演体」でゲームライターのバイトを経験、そこで『蓬莱学園』のアンソロジーに参加、次に出されたアンソロジーでレギュラーを務める。その後、富士見書房に後に1000万部を超える大ヒット作となる『フルメタル・パニック!』の原型となる作品を持ち込み、連載作家として活躍する。');
insert into Authors values( 'Gatoh_Shoji','zho', '贺东招二', '贺东招二(1971~)，日本轻小说家、编剧，滋贺县出身。受到大学时的SF研究会社团影响，从中央大学经济学部退学，加入游戏制作公司「游演体」。1994年，替公司推出的游戏「蓬莱学园」写小说合集，凭写作几本合集的经验，开始在富士见书房担任连载作家。作品《全金属狂潮》(フルメタル・パニック!，Full Metal Panic!)系列大受欢迎，更成为2007年《这本轻小说真厉害!》年度作品第一名。');

-- Genres Table
-- 
insert into Genres values( 'SF', 'eng', 'Science fiction', 'https://en.wikipedia.org/wiki/Science_fiction');
insert into Genres values( 'SF', 'jpn', 'サイエンス フィクション', 'https://ja.wikipedia.org/wiki/%E3%82%B5%E3%82%A4%E3%82%A8%E3%83%B3%E3%82%B9%E3%83%BB%E3%83%95%E3%82%A3%E3%82%AF%E3%82%B7%E3%83%A7%E3%83%B3');
insert into Genres values( 'SF', 'zho', '科幻', 'https://zh.wikipedia.org/wiki/%E7%A7%91%E5%AD%B8%E5%B9%BB%E6%83%B3');

insert into Genres values( 'Fantasy', 'eng', 'Fantasy', 'https://en.wikipedia.org/wiki/Fantasy');
insert into Genres values( 'Fantasy', 'jpn', 'ファンタジー', 'https://ja.wikipedia.org/wiki/%E3%83%95%E3%82%A1%E3%83%B3%E3%82%BF%E3%82%B8%E3%83%BC');
insert into Genres values( 'Fantasy', 'zho', '奇幻', 'https://zh.wikipedia.org/wiki/%E5%A5%87%E5%B9%BB%E4%BD%9C%E5%93%81');

insert into Genres values( 'Comedy', 'eng', 'Comedy', 'https://en.wikipedia.org/wiki/Comedy');
insert into Genres values( 'Comedy', 'jpn', 'コメディ', 'https://ja.wikipedia.org/wiki/%E5%96%9C%E5%8A%87');
insert into Genres values( 'Comedy', 'zho', '喜剧', 'https://zh.wikipedia.org/wiki/%E5%96%9C%E5%8A%87');

insert into Genres values( 'Romance', 'eng', 'Romance', 'https://en.wikipedia.org/wiki/Romance_novel');
insert into Genres values( 'Romance', 'jpn', '恋愛', 'https://ja.wikipedia.org/wiki/%E6%81%8B%E6%84%9B%E5%B0%8F%E8%AA%AC');
insert into Genres values( 'Romance', 'zho', '浪漫', 'https://zh.wikipedia.org/wiki/%E6%84%9B%E6%83%85%E5%B0%8F%E8%AA%AA');

insert into Genres values( 'Mystery', 'eng', 'Mystery', 'https://en.wikipedia.org/wiki/Mystery_fiction');
insert into Genres values( 'Mystery', 'jpn', 'ミステリ', 'https://ja.wikipedia.org/wiki/%E3%83%9F%E3%82%B9%E3%83%86%E3%83%AA');
insert into Genres values( 'Mystery', 'zho', '神秘', 'https://zh.wikipedia.org/wiki/%E7%A5%9E%E7%A7%98%E5%B0%8F%E8%AA%AA');

insert into Genres values( 'Horror', 'eng', 'Horror', 'https://en.wikipedia.org/wiki/Horror_fiction');
insert into Genres values( 'Horror', 'jpn', 'ホラー', 'https://ja.wikipedia.org/wiki/%E6%81%90%E6%80%96');
insert into Genres values( 'Horror', 'zho', '恐怖', 'https://zh.wikipedia.org/wiki/%E6%81%90%E6%83%A7');

insert into Genres values( 'Tragedy', 'eng', 'Tragedy', 'https://en.wikipedia.org/wiki/Tragedy');
insert into Genres values( 'Tragedy', 'jpn', '悲劇', 'https://ja.wikipedia.org/wiki/%E6%82%B2%E5%8A%87');
insert into Genres values( 'Tragedy', 'zho', '悲剧', 'https://zh.wikipedia.org/wiki/%E6%82%B2%E5%8A%87');

insert into Genres values( 'History', 'eng', 'History', 'https://en.wikipedia.org/wiki/Historical_fiction');
insert into Genres values( 'History', 'jpn', '歴史', 'https://ja.wikipedia.org/wiki/%E6%AD%B4%E5%8F%B2%E5%B0%8F%E8%AA%AC');
insert into Genres values( 'History', 'zho', '历史', 'https://zh.wikipedia.org/wiki/%E5%8E%86%E5%8F%B2%E5%B0%8F%E8%AF%B4');


-- Books Table
-- 
insert into Books values( 'Re_Zero_Novels','Nagatsuki_Tappei', 'Fantasy', DATE('2012-04-20 00:00:00'), null, null);
insert into Books values( 'The_Three_Body_Novels','Liu_Cixin', 'SF', DATE('2006-05-01 00:00:00'), null, null);
insert into Books values( 'The_Micro_Age_LCX','Liu_Cixin', 'SF', DATE('2006-05-01 00:00:00'), null, null);
insert into Books values( "The_Whales_Song_LCX",'Liu_Cixin', 'SF', DATE('2006-05-01 00:00:00'), null, null);
insert into Books values( 'Migration_Across_Time_LCX','Liu_Cixin', 'SF', DATE('2006-05-01 00:00:00'), null, null);
insert into Books values( 'Full_Metal_Panic_Novels','Gatoh_Shoji', 'SF', DATE('1998-09-18 00:00:00'), null, null);
insert into Books values( "Full_Metal_Panic_Another",'Gatoh_Shoji', 'SF', DATE('2011-08-20 00:00:00'), null, null);
-- BookDetails Table
-- 
insert into BookDetails values( 'Re_Zero_Novels','jpn', 'Ｒｅ：ゼロから始める異世界生活', DATE('2012-04-20 00:00:00'), 4768996, CURRENT_DATE(), "突如、コンビニ帰りに異世界へ召喚されたひきこもり学生の菜月昴。知識も技術も武力もコミュ能力もない、ないない尽くしの凡人が、チートボーナスを与えられることもなく放り込まれた異世界で必死こいて生き抜く。彼に与えられたたった一個の祝福は、『死んだら巻き戻ります』という痛みを伴う『死に戻り』のみ！　頼れるもののいない異世界で、いったい彼は何度死に、なにを掴み取るのか。　　※血も死体も出る予定ですが、そんな派手なことにはなりません。");
insert into BookDetails values( 'Re_Zero_Novels','zho', 'Re:从零开始异世界生活', DATE('2015-05-05 00:00:00'), null, CURRENT_DATE(), "走出便利商店要回家的高中生‧菜月昴突然被召唤到异世界。 这莫非就是很流行的异世界召唤!?可是眼前没有召唤者就算了，还遭遇强盗迅速面临性命危机。 这时，一名神秘银发美少女和猫精灵拯救了一筹莫展的他。 以报恩为名义，昴自告奋勇要帮助少女找东西。 然而，好不容易才掌握到线索，昴和少女却被不明人士攻击而殒命──本来应该是这样，但回过神来，昴却发现自己置身在第一次被召唤到这个异世界时的所在位置。 「死亡回归」──无力的少年得到的唯一能力，是死后时间会倒转回到一开始。跨越无数绝望，从死亡的命运中拯救少女！");
insert into BookDetails values( 'Re_Zero_Novels','eng', 'Re:Zero kara Hajimeru Isekai Seikatsu', DATE('2016-07-19 00:00:00'), null, CURRENT_DATE(), "Re:Zero kara Hajimeru Isekai Seikatsu (Re：ゼロから始める異世界生活, lit. Re: Life in a Different World from Zero), is a Japanese light novel series written by Nagatsuki Teppei and illustrated by Ootsuka Shinichirou. The series has been published by MF Bunjo J since January 2014, and also has a sub series known as Re:Zero kara Hajimeru Isekai Seikatsu Ex (Re：ゼロから始める異世界生活 Ex, lit. Re: Life in a Different World from Zero Ex), which covers the past before the series started.
The light novel series has been adapted into an anime series, which is currently being animated by White Fox and has been airing since April 2016. The series has been also adapted into several ongoing manga series; Parts 1 and 3 have been serialized in Gekkan Comic Alive while Part 2 has been serialized in Gekkan Big Gangan.");

insert into BookDetails values( 'The_Three_Body_Novels','jpn', '三体', 0, null, CURRENT_DATE(), '『三体』（さんたい）は、中華人民共和国のSF作家劉慈欣の長編SF小説。2006年5月から12月まで、中国のSF雑誌『科幻世界』（中国語）で連載され、2007年に重慶出版社によって単行本が出版された。本作は「地球往事三部作」シリーズの第一作であり、第二作である『三体II：黒暗森林』は2008年5月に出版され、第三作である『三体III：死神永生』は2010年11月に出版された。
本作、またこれを含む「地球往事三部作」(『三体』三部作ともいう)は中国において最も人気のあるSF小説の一つとされ、2015年時点で50万組以上を売り上げている。また、本作は2014年11月に劉宇昆による英訳が出版され、これも複数のSF賞にノミネートされるなど高く評価されている。
映画化も行われており、張番番監督・馮紹峰主演で2016年7月に3D映画として公開予定である。');
insert into BookDetails values( 'The_Three_Body_Novels','zho', '三体', DATE('2008-01-01 00:00:00'), null, CURRENT_DATE(), '《三体》是刘慈欣于2006年5月至12月在《科幻世界》杂志上连载的长篇太空歌剧，出版后成为中国大陆最畅销的科幻长篇小说之一。2008年，该书的单行本由重庆出版社出版。本书是“三体”系列（系列原名为：地球往事三部曲）的第一部，该系列的第二部《三体II：黑暗森林》已经于2008年5月出版。2010年11月，第三部《三体III：死神永生》出版发行。 2011年，“地球往事三部曲”在台湾陆续出版。小说的英文版获得美国科幻奇幻作家协会2014年度“星云奖”提名，并荣获2015年雨果奖最佳小说奖。');
insert into BookDetails values( 'The_Three_Body_Novels','eng', 'The Three-Body Problem', DATE('2014-11-11 00:00:00'), null, CURRENT_DATE(), 'The Three-Body Problem is a science fiction novel by the Chinese writer Liu Cixin. It is the first of a trilogy titled Remembrance of Earth’s Past, but Chinese readers generally refer to the series by the title of the first novel. The title itself refers to the three-body problem in orbital mechanics (Although technically the problem described in the book is a four body problem).
The work was serialized in Science Fiction World in 2006, published as a book in 2008 and became one of the most popular science fiction novels in China. It received the Chinese Science Fiction Galaxy Award in 2006. A film adaptation of the same name is scheduled for release in July 2016.
An English translation by Ken Liu was published by Tor Books in 2014. It won the 2015 Hugo Award for Best Novel and was nominated for the 2014 Nebula Award for Best Novel.');

insert into BookDetails values( 'Full_Metal_Panic_Novels','jpn', 'フルメタル・パニック!', DATE('1998-09-18'), null, CURRENT_DATE(), "幼少期から戦場に身を置き、生き抜いてきた兵士を主人公にしたSFミリタリーアクション作品である。
現在、本筋となる長編が全12巻、番外編の短編が全9巻、外伝のサイドアームズが2巻の全23巻が発行されている。タイトルはスタンリー・キューブリックの映画『フルメタル・ジャケット』をもじったものであり、フルメタと略して呼ばれることが多い。同映画との混同をさけるため、完全金属騒乱（榊一郎や雑賀礼史が著作のあとがきにて表記）と呼ばれることもある。
シリーズ累計の発行部数は1100万部を超える.");
insert into BookDetails values( 'Full_Metal_Panic_Novels','zho', '全金属狂潮', DATE('2004-02-23 00:00:00'), 2909505, CURRENT_DATE(), "《全金属狂潮》是日本作家贺东招二于1998年开始创作的轻小说，插画四季童子，是富士见书房出版的人气系列作品，长篇最终卷已于2010年7、8月分上下卷出版。已改编动画，亦在电子游戏《超级机器人大战》系列的GBA作品《超级机器人大战J》及在NDS作品-《超级机器人大战W》登场。");
insert into BookDetails values( 'Full_Metal_Panic_Novels','eng', 'Full Metal Panic!', DATE('2007-09-11 00:00:00'), null, CURRENT_DATE(), "(フルメタル·パニック! Furumetaru Panikku!?, often abbreviated to FMP!) is a series of light novels written by Shoji Gatoh and illustrated by Shiki Douji. The series follows Sousuke Sagara, a member of the covert anti-terrorist private military organization known as Mithril , tasked with protecting Kaname Chidori, a spirited Japanese high school girl.");

insert into BookDetails values( 'Full_Metal_Panic_Another','jpn', 'フルメタル・パニック!アナザー', DATE('2011-08-20'), null, CURRENT_DATE(), "幼少期から戦場に身を置き、生き抜いてきた兵士を主人公にしたSFミリタリーアクション作品である。
現在、本筋となる長編が全12巻、番外編の短編が全9巻、外伝のサイドアームズが2巻の全23巻が発行されている。タイトルはスタンリー・キューブリックの映画『フルメタル・ジャケット』をもじったものであり、フルメタと略して呼ばれることが多い。同映画との混同をさけるため、完全金属騒乱（榊一郎や雑賀礼史が著作のあとがきにて表記）と呼ばれることもある。
シリーズ累計の発行部数は1100万部を超える.");
insert into BookDetails values( 'Full_Metal_Panic_Another','zho', '全金属狂潮Another', DATE('2004-02-23 00:00:00'), 2909505, CURRENT_DATE(), "《全金属狂潮》是日本作家贺东招二于1998年开始创作的轻小说，插画四季童子，是富士见书房出版的人气系列作品，长篇最终卷已于2010年7、8月分上下卷出版。已改编动画，亦在电子游戏《超级机器人大战》系列的GBA作品《超级机器人大战J》及在NDS作品-《超级机器人大战W》登场。");
insert into BookDetails values( 'Full_Metal_Panic_Another','eng', 'Full Metal Panic! Another', DATE('2007-09-11 00:00:00'), null, CURRENT_DATE(), "(フルメタル·パニック! Furumetaru Panikku!?, often abbreviated to FMP!) is a series of light novels written by Shoji Gatoh and illustrated by Shiki Douji. The series follows Sousuke Sagara, a member of the covert anti-terrorist private military organization known as Mithril , tasked with protecting Kaname Chidori, a spirited Japanese high school girl.");

-- Links Table
-- 
insert into Links values('http://ncode.syosetu.com/n2267be/', 'ＷＥＢ版を読む','Re_Zero_Novels','jpn', crc32('http://ncode.syosetu.com/n2267be/'));
insert into Links values('http://www.amazon.co.jp/dp/4040662083', 'AMAZONで購入','Re_Zero_Novels','jpn', crc32('http://www.amazon.co.jp/dp/4040662083'));
insert into Links values('http://xs.dmzj.com/1873/index.shtml', '全文阅读-动漫之家','Re_Zero_Novels','zho', crc32('http://xs.dmzj.com/1873/index.shtml'));
insert into Links values('http://re-zero.com/', '公式サイト','Re_Zero_Novels','jpn', crc32('http://re-zero.com/'));

insert into Links values('http://www.shizongzui.cc/santi/', '全文阅读-网络','The_Three_Body_Novels','zho', crc32('http://www.shizongzui.cc/santi/'));
insert into Links values('http://www.tor.com/2014/10/28/read-the-three-body-problem/', 'Official Free Samples','The_Three_Body_Novels','eng', crc32('http://www.tor.com/2014/10/28/read-the-three-body-problem/'));
insert into Links values('https://www.amazon.ca/dp/0765377063', 'Purchase on Amazon','The_Three_Body_Novels','eng', crc32('https://www.amazon.ca/dp/0765377063'));
insert into Links values('http://www.worldcat.org/title/three-body-problem/oclc/868276526', 'Find in Libraries','The_Three_Body_Novels','eng', crc32('http://www.worldcat.org/title/three-body-problem/oclc/868276526'));

-- Members Table
-- 
insert into Members values( 'adam', sha1('awsome123'), 'zho', null);
insert into Members values( 'bob', sha1('greatpassword'), 'eng', null);
insert into Members values( 'chashaobao', sha1('chashaobao'), 'jpn', null);
insert into Members values( 'guest', sha1('guest'), null, null);

-- HSBooks Table
-- 
insert into HSBooks values( 'adam', 'Re_Zero_Novels', DATE_SUB(NOW(),INTERVAL 5 DAY));
insert into HSBooks values( 'adam', 'The_Three_Body_Novels', DATE_SUB(NOW(),INTERVAL 3 DAY));
insert into HSBooks values( 'bob', 'Re_Zero_Novels', DATE_SUB(NOW(),INTERVAL 1 DAY));
insert into HSBooks values( 'chashaobao', 'The_Three_Body_Novels', NOW());
insert into HSBooks values( 'chashaobao', 'Re_Zero_Novels', DATE_SUB(NOW(),INTERVAL 2 DAY));

-- HSAuthors Table
-- 
insert into HSAuthors values( 'adam', 'Nagatsuki_Tappei', DATE_SUB(NOW(),INTERVAL 5 DAY));
insert into HSAuthors values( 'adam', 'Liu_Cixin', DATE_SUB(NOW(),INTERVAL 3 DAY));
insert into HSAuthors values( 'bob', 'Nagatsuki_Tappei', DATE_SUB(NOW(),INTERVAL 1 DAY));
insert into HSAuthors values( 'chashaobao', 'Nagatsuki_Tappei', NOW());
insert into HSAuthors values( 'chashaobao', 'Liu_Cixin', DATE_SUB(NOW(),INTERVAL 2 DAY));

-- FAVBooks Table
-- 
insert into FAVBooks values( 'adam', 'Re_Zero_Novels', DATE(DATE_SUB(NOW(),INTERVAL 5 DAY)));
insert into FAVBooks values( 'adam', 'The_Three_Body_Novels', DATE(DATE_SUB(NOW(),INTERVAL 3 DAY)));
insert into FAVBooks values( 'bob', 'Re_Zero_Novels', DATE(DATE_SUB(NOW(),INTERVAL 1 DAY)));
insert into FAVBooks values( 'chashaobao', 'The_Three_Body_Novels', DATE(NOW()));
insert into FAVBooks values( 'chashaobao', 'Re_Zero_Novels', DATE(DATE_SUB(NOW(),INTERVAL 2 DAY)));

-- FAVAuthors Table
-- 
insert into FAVAuthors values( 'adam', 'Nagatsuki_Tappei', DATE(DATE_SUB(NOW(),INTERVAL 5 DAY)));
insert into FAVAuthors values( 'adam', 'Liu_Cixin', DATE(DATE_SUB(NOW(),INTERVAL 3 DAY)));
insert into FAVAuthors values( 'bob', 'Nagatsuki_Tappei', DATE(DATE_SUB(NOW(),INTERVAL 1 DAY)));
insert into FAVAuthors values( 'chashaobao', 'Nagatsuki_Tappei', DATE(NOW()));
insert into FAVAuthors values( 'chashaobao', 'Liu_Cixin', DATE(DATE_SUB(NOW(),INTERVAL 2 DAY)));

-- CMTBooks Table
-- 
insert into CMTBooks(TStamp, BID, Content) values( DATE_SUB(NOW(),INTERVAL 5 DAY), 'Re_Zero_Novels','this is a short commnet 1 for a book 1');
insert into CMTBooks(TStamp, BID, Content) values( DATE_SUB(NOW(),INTERVAL 3 DAY), 'The_Three_Body_Novels', 'this is a short commnet 1 for a book 2');
insert into CMTBooks(TStamp, BID, Content) values( DATE_SUB(NOW(),INTERVAL 1 DAY), 'Re_Zero_Novels', 'this is a short commnet 1 for a book 3');
insert into CMTBooks(TStamp, BID, Content) values( NOW(), 'The_Three_Body_Novels', 'this is a short commnet 1 for a book 4');
insert into CMTBooks(TStamp, BID, Content) values( DATE_SUB(NOW(),INTERVAL 2 DAY), 'Re_Zero_Novels', 'this is a short commnet 1 for a book 5');

-- CMTAuthors Table
-- 
insert into CMTAuthors(TStamp, AID, Content) values( DATE_SUB(NOW(),INTERVAL 5 DAY), 'Nagatsuki_Tappei', 'this is a short commnet 1 for an author 1');
insert into CMTAuthors(TStamp, AID, Content) values( DATE_SUB(NOW(),INTERVAL 3 DAY), 'Liu_Cixin', 'this is a short commnet 1 for an author 1');
insert into CMTAuthors(TStamp, AID, Content) values( DATE_SUB(NOW(),INTERVAL 1 DAY), 'Nagatsuki_Tappei', 'this is a short commnet 1 for an author 1');
insert into CMTAuthors(TStamp, AID, Content) values( NOW(), 'Nagatsuki_Tappei', 'this is a short commnet 1 for an author 1');
insert into CMTAuthors(TStamp, AID, Content) values( DATE_SUB(NOW(),INTERVAL 2 DAY), 'Liu_Cixin', 'this is a short commnet 1 for an author 1');
