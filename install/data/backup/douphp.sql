-- douweb v1.x SQL Dump Program
-- http://localhost/douphp/
-- 
-- DATE : 2014-09-22 16:19:42
-- MYSQL SERVER VERSION : 5.0.90-community-nt
-- PHP VERSION : 5.2.14
-- Douweb VERSION : 

DROP TABLE IF EXISTS dou_admin;
CREATE TABLE `dou_admin` (
  `user_id` smallint(5) unsigned NOT NULL auto_increment,
  `user_name` varchar(60) NOT NULL default '',
  `email` varchar(60) NOT NULL default '',
  `password` varchar(32) NOT NULL default '',
  `action_list` text NOT NULL,
  `add_time` int(11) NOT NULL default '0',
  `last_login` int(11) NOT NULL default '0',
  `last_ip` varchar(15) NOT NULL default '',
  PRIMARY KEY  (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO dou_admin VALUES('1','admin','admin@admin.com','7fef6171469e80d32c0559f88b377245','ALL','1377768032','1411098722','127.0.0.1');

DROP TABLE IF EXISTS dou_admin_log;
CREATE TABLE `dou_admin_log` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `create_time` int(10) unsigned NOT NULL default '0',
  `user_id` tinyint(3) unsigned NOT NULL default '0',
  `action` varchar(255) NOT NULL default '',
  `ip` varchar(15) NOT NULL default '',
  PRIMARY KEY  (`id`),
  KEY `create_time` (`create_time`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

INSERT INTO dou_admin_log VALUES('1','1381887740','1','系统设置: 编辑成功','127.0.0.1');
INSERT INTO dou_admin_log VALUES('2','1381887745','1','编辑导航: 公司简介','127.0.0.1');
INSERT INTO dou_admin_log VALUES('3','1381887749','1','编辑幻灯: 广告图片01','127.0.0.1');
INSERT INTO dou_admin_log VALUES('4','1381887753','1','编辑单页面: 联系我们','127.0.0.1');
INSERT INTO dou_admin_log VALUES('5','1381887756','1','编辑商品分类: 电子数码','127.0.0.1');
INSERT INTO dou_admin_log VALUES('6','1381887759','1','编辑文章分类: 公司动态','127.0.0.1');
INSERT INTO dou_admin_log VALUES('7','1381887775','1','编辑单页面: 企业荣誉','127.0.0.1');
INSERT INTO dou_admin_log VALUES('8','1381887778','1','编辑单页面: 公司简介','127.0.0.1');
INSERT INTO dou_admin_log VALUES('9','1381887781','1','编辑单页面: 营销网络','127.0.0.1');
INSERT INTO dou_admin_log VALUES('10','1381980020','1','恢复备份: douphp.sql','127.0.0.1');
INSERT INTO dou_admin_log VALUES('11','1382062229','1','管理员登录: 登录成功！','127.0.0.1');
INSERT INTO dou_admin_log VALUES('12','1382103121','1','管理员登录: 登录成功！','127.0.0.1');
INSERT INTO dou_admin_log VALUES('13','1399999423','1','恢复备份: douphp.sql','127.0.0.1');
INSERT INTO dou_admin_log VALUES('14','1399999438','1','添加导航: 留言板','127.0.0.1');
INSERT INTO dou_admin_log VALUES('15','1399999494','1','删除导航: 联系我们','127.0.0.1');
INSERT INTO dou_admin_log VALUES('16','1400078869','1','管理员登录: 登录成功！','127.0.0.1');

DROP TABLE IF EXISTS dou_article;
CREATE TABLE `dou_article` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `cat_id` smallint(5) NOT NULL default '0',
  `title` varchar(150) NOT NULL default '',
  `defined` text NOT NULL,
  `content` longtext NOT NULL,
  `image` varchar(255) NOT NULL default '',
  `keywords` varchar(255) NOT NULL default '',
  `add_time` int(10) unsigned NOT NULL default '0',
  `click` smallint(6) unsigned NOT NULL default '0',
  `description` varchar(255) NOT NULL default '',
  `home_sort` varchar(2) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

INSERT INTO dou_article VALUES('1','1','企业网站建设的重要性','','在一个网络时代，企业网上的形象即网站的形象，是十分重要的。它的定位与网页设计直接影响着企业在网络电子商务应用推广中的成败，试想如果一家知名公司（企业）的网站设计定位很差，这不仅会严重损坏这个企业原本在人们心中的形象，而且对于其在网上扩大知名度和推广都是相当不利的。纵观国内外知名企业的网站，我们不难发现这样的规律：企业的知名度和实力往往与其企业网站的设计制作水平成正比。<br />\r\n<br />\r\n第一、利用企业网页，宣传企业自身<br />\r\n在企业的互联网服务系统上，企业可向外宣传企业的文化、企业的概况、产品、服务品质以及新闻等方面的内容。 发布在互联网上的信息可以制作得较为祥尽，包括产品的各种性能参数，使用说明等；利用图文声像并茂的网页形象宣传企业，以利于企业更科学地进行市场开拓。&nbsp;<br />\r\n<br />\r\n第二、推广提高产品品牌<br />\r\n在通过企业网页宣传企业的同时，更加宣传了企业的产品，使其网页上的产品信息更加方便地传达到全球的目标客户群，建立网站前的企业，产品销售渠道受到了很大的限制，建立网站后，获得了更大的受众群体，为企业的产品走向国际打下了坚实的基础，从而不断提高产品的品牌形象。&nbsp;<br />\r\n<br />\r\n第三、利用网上电子商务，降低企业销售成本及原材料采购成本，提高产品竞争力<br />\r\n在电子商务方式下，企业的商业机会得到有效扩大，可通过专业公司为您提供网上策划，将信息传递给需求群体。利用电子商务通过互联网与客户建立方便的联络方式进行业务洽谈。大幅度减少了人员出差的时间和费用，降低通信、传真、邮寄费用，并省去了许多中间环节，提高了产品直销率，降低了经营成本。 通过在自己网页的BBS公告牌上发布商品需求信息，同时主动在网上查询所城原材料及配件的相关生产厂家的信息，并与其直接联系采购，从而有效降低了采购成本。&nbsp;<br />\r\n<br />\r\n第四、通过互联网寻求合资，合作伙伴.<br />\r\n企业在寻求合资、合作伙伴中，可利用自身的网上形象以及在相关知名的BBS上发布信息，以求目标对象获得您的信息。另外也可主动在互联网上寻找目标对象。利用互联网寻求商贸合资、合作伙伴具有很大的优越性，并可有效地减少寻求目标对象的盲目性，因为您可以在网上详细查看对方的简介、产品介绍等情况之后，再进行下一步的实施考察和技术交流活动，从而大大减少不必要的费用支出，做到有的放矢。&nbsp;<br />\r\n<br />\r\n第五、进行行业信息收集及日常电子邮件传输，促进了信息的交流<br />\r\n互联网在行业信息收集方面是任何媒体所无法比拟的。借助互联网的强大优势，可在网上随时随地查找您所要获得的行业宏观信息、同行竞争对手的发展及产品信息，还可在企业的网站上建立起自己的专门栏目，收集用户的反馈信息，保证了在较短时间内获得最新的信息。 在与客户的交流中，可充分利用E-mail的费用低（其通讯费用只有传统通讯方式的1/5-1/20）、速度快、一信多发等优点。而且距离越远相对费用就越低。更为重要的是，可以很方便地对信件进行二次编辑，避免了文件的重复输入，几乎可以不用传真机，将电子邮件的优越性能发挥得淋漓尽致。&nbsp;<br />\r\n<br />\r\n第六、加强了对目标对象的售前服务，提升了企业的服务品质<br />\r\n“品质就是硬道理”企业可以通过因特网，对目标客户进行在线产品信息查询、技术支持等服务、为客户提供了一个便于查询的服务系统，并且可以把常见的客户反馈信息，经过处理后，发布在网上，供更多的客户查阅，通过不断地为客户进行网上的在线咨询、技术支持等方式，达到渐渐提升企业服务品质之目的。 网上信息可供不同需求的用户24小时查询，而且通过电子邮件的形式，大大摆脱了传统业务活动过程的诸多不方便行为。从而加强了对客户的各方面服务。<br />\r\n<br />','','企业网站建设,为什么要建企业网站,企业网站的重要性','1372261194','0','','');
INSERT INTO dou_article VALUES('2','1','如何利用电子商务提升企业竞争力','','电子商务是在计算机网络的平台上，按照一定通信标准和协议开展的商务活动。它不仅是一种互联网的在线销售模式，更重要的是，企业与企业之间、企业与消费者之间、消费者与消费者之间、企业与政府行政部门之间的信息交流实现了数据化的处理过程。电子商务包括各种有商业能力的实体及所涉及到的金融、税务、教育、社会的其它层面之间会相互影响，相互作用。尽管目前许多企业并未全部实现交易的电子化和商务过程的网络数字化，但是伴随着信息技术、互联网的发展及其商业应用水平的不断提高，电子商务的发展必将逐渐打破企业、行业界限，使不同企业、行业共同参与到某一商务交易活动中，成市场为一个复杂、多变的竞争体系。<br />\r\n<br />\r\n电子商务源于传统的商务活动，但又不同于传统商务形式。它是在计算机网络和传统商务基础上的一种突破时空和地域界限的新的商务形式。一般认为电子商的特征应包括一下几个方面：首先是全球化市场定位，透过互联网机制，可迅速且容易的扩大市场及供应链，使之涵盖全世界上下游潜在的客户与供货商。同时市场开放透明的价格和低进入障碍及全天候运转，使得市场蓬勃发展，势头强劲。其次，个性化需求的交互式管理及快速有效响应，加之交易的迅捷，使得网上购物更具吸引力。最后，市场交易信息存储、整理、完善，为企业管理决策提供了及时可靠的依据。<br />\r\n<br />\r\n“企业竞争力”是由企业的一系列特殊资源的组合而形成的占领市场、获得长期利润的能力。一般认为它包括企业的人力资本、核心技术、企业声誉、营销技术管理能力、管理者的能力、经营者驾驭财务杠杆的能力、企业文化等等。在网络环境下，企业无论大小，企业形象、声誉都将通过网站或页面表现出来，企业面对的将是相同的开放的市场，处于相同的平等的竞争条件下，与消费者的距离也并遥远，一些语言障碍也可以被轻易扫除。因此，无论哪种类型的电子商务，都会对企业的竞争力产生不可忽视的影响。<br />\r\n<br />\r\n首先，电子商务将改变企业的竞争领域。电子商务扩大了企业的竞争领域，使企业从常规的广告竞争、促销手段、产品设计与市场细分等领域的竞争扩大到无形的虚拟的竞争空间。同时电子商务可以在组织间和组织内部进行，因此电子商务加强了企业内部信息资源的迅速沟通，增强了产业链之间的合作，改善上下游企业之间的成本结构，这使得电子商务模式下的竞争不再是单个企业和单个企业之间的竞争，而是产业链内部和产业链之间的竞争。<br />\r\n<br />\r\n其次，电子商务将改变企业的竞争基础。电子商务和网络技术的发展，使传统意义上的商务活动发生了根本性的变革，从而改变企业的竞争基础。在电子商务条件下，网络成为真正的世界市场，企业营销管理人员通过网络可以让整个世界市场呈现于眼底，轻松便捷的点击、互访便能获得更多的商业机会。同时网络打破了时空的限制，使企业获得用销售人员、经济情报人员和各种广告所不能得到的新客户和新市场。应用电子商务也大大节省了企业营运资金，网络信息传递使企业的产品成本和交易成本大大降低，通过虚拟站点和虚拟商店节省了硬件营销场所、人力和营销店面的维护等方面的巨大投资，全面而极大地节省了企业的营运资金。另外，企业还可迅速地了解市场供求状况，使企业的决策更趋于准确化，极大地降低了企业资金投入的风险。<br />\r\n<br />\r\n最后，电子商务将改变企业竞争的手段。电子商务的出现，人们可以直接从网络上采购、批零。传统方式的营销方式将被网络代替，传统的人员广告宣传将逐渐也为适应新的营销环境而改变。企业对目标市场的选择和定位，将更加依赖于上网者的资料以及对网络的充分利用。企业的市场调研、产品组合和分销等一系列营销管理活动将会因电子商务而发生改变。<br />\r\n<div>\r\n	<br />\r\n</div>','','电子商务,企业竞争力','1372261407','0','','');
INSERT INTO dou_article VALUES('3','1','网络营销之该如何打造吸引性的软文营销','','软文是什么，到底起什么作用。我记得在SEO研究中心网络营销公开课时候问过大家，大家都回答的很模糊。那么到底什么是软文。软文营销主要体现的价值是什么，如果才能做吸引力的软文营销。而且可以让软文产生很大的用户访问量。还能够起到营销作用……<br />\r\n<br />\r\n那么我们就不得不去了解一下什么是软文营销<br />\r\n<br />\r\n所谓”软文”，就是指通过特定的概念书写、以摆事实讲道理的方式吸引消费者和我们的目标用户，。比如：新闻，第三方评论，访谈，采访，口碑。软文是基于特定产品的概念诉求与问题分析，对消费者进行针对性心理引导的一种文字模式，从本质上来说，它是企业软性渗透的商业策略在广告形式上的实现，通常借助文字表达与舆论传播使消费者认同某种概念、观点和分析思路，从而达到企业品牌宣传、产品销售、活动推广、服务推广等的目的。<br />\r\n<br />\r\n软文营销可以发挥的作用是什么？<br />\r\n<br />\r\n1、软文营销给网络营销带来的价值以及发挥的作用<br />\r\n<br />\r\n那么软文营销既然可以达到宣传产品、宣传活动、企业推广以及服务推广。那就说明我们可以应用的领域可以是做网络营销的平台营销，做企业的品牌塑造，可以去通过新闻源、论坛等等树立公司的权威和信任度。可以通过产品和企业进行关联。加深用户对产品印象以及公司产品营销。还有就是进行一个企业活动的营销策划。这是对于我们做网络营销的人可以应用到的。当然互联网也存在很多的成功案例。例如做伟哥系列的产品利用情感、两性来进行做软文营销可以达到很高的一个宣传量。例如上海世博会时候运用到软文营销带来很大的用户认知。<br />\r\n<br />\r\n<br />\r\n例：世博会，通过腾讯，百度、新浪等很多平台进行做博客，做文章，来做这次活动宣传，说明了软文的重要性<br />\r\n<br />\r\n2、软文营销对于网站运营起到的价值和作用<br />\r\n<br />\r\n网站运营顾名思义，一个网站需要大力的发展。开始前期的过程就是SEO优化。当我们在优化同时在很多品牌词、目标词都有很好排名表现之后，需要做什么。当然是营销。营销可以辅助进行给我们的网站引导流量。让我们的网站提升流量。<br />\r\n<br />\r\n当然我们同样可以通过软文写作投放到新闻源网站、以及权威网站打造网站知名度以及配合很多的社交网站做品牌的塑造力。当然做品牌塑造力有很多内容。但是其中软文占得比例是非常高的。<br />\r\n<br />\r\n软文写作还有一定就是引导用户到我们特定的一个页面，例如活动页面、促销页面、产品销售页面增加我们网站页面的转化率。当然这一方面做营销比较好的。例如淘宝天猫2012年的双十一，他们通过软文营销做邮件群发、新闻源以及百度系列等投放吸引用户去关注。<br />\r\n<br />\r\n<br />\r\n<br />\r\n例如：2012年淘宝双十一的营销方案，主要是大量的流量引导到网站上面形式。<br />\r\n<br />\r\n在写软文时候我们需要准备什么？<br />\r\n<br />\r\n1、要熟悉我们做的行业，了解我们的产品、以及品牌文化。<br />\r\n<br />\r\n2、要去在互联网上熟悉我们的行业，在互联网上呈现的状况。然后分析看那些市场没有满足，那些需求不够完善。（然后去分析出来针对性做营销方案，吸引用户达到营销目的）<br />\r\n<br />\r\n3、去挖掘和你们产品（目标词）相关的词汇，出现的长尾词。然后进行分类，每天规划去写一部分内容。<br />\r\n<br />\r\n如何书写一篇有营销价值的文章。<br />\r\n<br />\r\n&nbsp;1、挖掘我们的关键词之后，我们首先是需要了解我们的行业。知道我们做的长尾词需要的内容要点。自己形成思路然后进行书写。<br />\r\n<br />\r\n在书写过程中存在这样两种现象，一种就是对于我们的行业非常了解的。二者就是不了解行业形势的。<br />\r\n<br />\r\n（1）如果你了解我们的行业。那我们就可以去观察同行业在论坛或者资讯网站投放的文章。看看，然后分析出他们没有到位的。或者是存在的一些需求没有满足。这就是有基础的形式编辑，可以写出一些差异化。而且用户比较关注的内容。但是这个是要基于用户的了解。<br />\r\n<br />\r\n（2）当我们对于自己行业不太了解，或者我们需要做大量的文章。又没有大量时间去做原创文章去引导流量。那么我们该怎么办。就需要发现优质文章，进行加工修改，加上我们的品牌词形式这样就会凸显出价值了。当然这些在针对性有些平台是要求原创的。就无法投稿了。<br />\r\n<br />\r\n&nbsp;2、我们在写软文时候要注意的一些细节问题<br />\r\n<br />\r\n标题：拟定要够吸引力，如果你的标题不够吸引力。就很难去吸引人关注<br />\r\n<br />\r\n概况，这个针对我们很多网站都有概况。当然在搜索引擎中。也会去抓取一段内容。那么这段话吸引不够吸引也是很关键的。<br />\r\n<br />\r\n内容：要写好一个软文。是否可以让吸引用户，让用户感受到价值。而且起到营销目的。那么在前面我也讲到。网络营销的价值。<br />\r\n<br />\r\n针对内容，我就得多说几点，如何让我们的广告在软文中发挥价值。从而文章被大量转载时候还带着营销效果。这个就需要掌握以下三个知识点：<br />\r\n<br />\r\n#1、这里出现一展现品牌词、目标词为核心。而不是以链接为核心。我们很多人前期一直在做外链推广。所以就带着这样的思维。真正的软文营销在SEO中发挥价值是，吸引用户通过观看软文后，引发二次搜索你的品牌词。所以这个是需要注意的<br />\r\n<br />\r\n#2、在写软文的时候出现品牌词、目标词主要是展现这为核心，那怎么保证这个信息不会被删除那。所以主要是在写软文时候要把这些词汇当做必然要出现的，而不是很不和谐的出现。这样就容易被删除，例如你写一篇文章叫做SEO培训系列文章，那么你加上SEO研究中心就是需要有必然因素出现，如果缺少了或者被替换了就不通顺的感觉。这样价值意义就大了。<br />\r\n<br />\r\n#3、要找对平台，针对性投放。我们要找对平台投放软文的技巧和方式以及规律。发现那些发布成功的文章具备的优势。首先我们先解决软文投稿通过率问题。因为开始掌握了这些写作技巧，懂得你这个行业也不一定能够进行去投稿成功。重点是要观察平台。然后进行投稿。<br />\r\n<br />\r\n软文写作的升华篇：提升流量和转化效果<br />\r\n<br />\r\n1、首先我给大家说说，怎么去做好软文写作的思维。<br />\r\n<br />\r\n例如：我们写的是产品类型文章，那么我们重点是写出我们的产品属性以及品牌和提供的价值和服务。然后我们进行要转化的一个关键。就是在用户读完这篇文章，然后进行直观的推荐。因为当用户通过这个页面了解了你的产品，心理产生了兴趣就应该给他引导了。但是注意不能出现在中间或者头部，因为当用户都没有了解产品。你都在推荐。这样是无法让用户信服和相信。要有流程化。<br />\r\n<br />\r\n例如：我们写技术类型文章，那么我们重点是在说明一个观点或者说明一个事实。那其中难免会出现一些词汇导致用户不理解。所以这些就需要去加上链接进行解释说明，或者（）进行说明形式，而且在这个链接插入记住一定是新窗口打开。这样两个或者几个页面可以对照去看。便于理解。<br />\r\n<br />\r\n2、软文写作如何提升流量。<br />\r\n<br />\r\n我们一般投放软文都是在平台形式的，那么我们在写作时候都要注意。首先要去观察搜索引擎你的目标词中那些长尾是吸引用户关注的，你要投放软文的平台首页大多数都是编辑推荐的。了解这些文字的特性和主题。<br />\r\n<br />\r\n然后去找和这些内容比较相关的，以及这段时间比较关注的热点。会倾向于那个方面。这样进行编辑内容。然后加上优质的标题和内容概括，就会通过搜索引擎带来很大流量。同时也会被推荐到这个平台的网站栏目页或者首页。<br />','','网络营销,软文营销','1372261508','0','','');
INSERT INTO dou_article VALUES('4','1','一个新手要如何着手来做好网站运营？','','网络营销里面一个很重要的名词就是网站运营，一个没有网站运营经验的人要如何来展开这项工作呢？<br />\r\n<br />\r\n站长个人觉得首先你应该要懂得什么叫网站运营，了解它需要做的工作，然后制定相关的工作计划，最后分配给下面的人分工合作。<br />\r\n<br />\r\n网站运营的范畴通常包括网站内容的更新与维护、网站流程的优化、数据挖掘的分析、用户研究的管理以及网站营销的策划等等。这里面PV、IP、注册用户、在线用户、付费用户、在线时长、购买频次‘ARPU值等等都是很重要的因素。<br />\r\n<br />\r\n什么样的网站运营才算是成功的运营呢？这就要从网站运营的一些必要因素上面去衡量了，比如专业性、互动性、用户体验、域名注册查询等等，用一个简单的公示来表示就是：专业+互动+用户体验+两点=盈利<br />\r\n<br />\r\n一个企业网站的运营包括了很多的内容，比如网站的宣传推广、网络营销的管理、网站的完善变化、网站的后期维护与更新，网站的企业化操作等等。网站的维护和推广是其中最重要的。<br />\r\n<br />\r\n到底该如何来成功维护一个网站呢？一个网站成功运营起来还有很多工作要做，运营是包括了很多的方向的，必须要瞄准这些方向我们才有可能有机会获得运营的成功。<br />\r\n<br />\r\n我们需要瞄准的第一个方向是客户的方向。简单来说就是站在客户的角度去想问题，我们很多站长觉得这是一个很简单的事，但是事实上能站在客户角度去想问题的又有几个呢？真正做到为客户想的人不是把自己的产品如何做好，而是产品能为客户带来什么，客户能得到一些实质性的东西这才是最实在的，所以在产品设计上要和运营一起完成一次又一次不可能的任务解决好一些问题才能使得网站运营的成功的可能性提高。<br />\r\n<br />\r\n第二就是网站的运营离不开市场的发展。所以市场的运营需要考虑的一个重要的因素就是选择什么样的人群来作为目标市场，这一直是个很高的学问。寻找市场运营的要素包括：网站市场的渠道，网站在不同时期所适合的运营方式，以及什么样的资源可以整合起来运用，网站能否运营好这些都是很重要的方向。<br />\r\n<br />\r\n第三就是合作和共赢。一个没有合作的网站是很难生存的，这就包括了公司上下之间的合作以及公司和外界的合作。网站的信息合作能增加网站资源的丰富程度，这样带来的流量也就比较多，网站运营的成功机会才会大大的增加。细节决定成败，做网站运营同样需要注重细节，每一个细节都不能放过。<br />','','网站运营','1372261551','0','','');
INSERT INTO dou_article VALUES('5','1','网站建设要素之如何制定一份网站策划方案','','要建立一个网站，需要从网站定位，到设计、网站结构、内容准备、内外链的建设等等，是一个复杂繁琐的过程，需要准备一份网站的策划方案。本文将简要描述，从网站的定位到最终的网站建成，整个过程。<br />\r\n<br />\r\n一、网站的定位<br />\r\n<br />\r\n分析：给网站定位，策划一个网站，这是第一步，只有给网站定位好了，才能按照定位的关键词展开。如何给网站定位，如何选择网站的核心关键词。选择核心关键词，需要考虑的因素有：搜索量大、有一定的商业价值、竞争度相对较低。<br />\r\n<br />\r\n这里有个小建议，一般建站前，肯定清楚网站属于哪一个类别，然后根据这个类别的核心关键词，通过百度蜂巢系统，将相关关键词拉出，再根据需要考虑的因素，选择最合适的关键词<br />\r\n<br />\r\n二、确定网站三要素<br />\r\n<br />\r\n分析：建站的三要素，指的是程序、域名和空间，在确定了网站的核心关键词以后，可以由关键词确定网站名称，然后再根据网站名称，选择域名；根据网站主题，选择程序；关于空间，最好是正规空间商提供的服务器，稳定、安全，虽然价格可能比较贵。<br />\r\n<br />\r\n在建立网站需要哪些条件一文中，有详细介绍网站三要素的内容，感兴趣的童鞋可以看看。<br />\r\n<br />\r\n三、确定网站关键词<br />\r\n<br />\r\n分析：这里所说的关键词，是根据已经定位好的核心关键词，再总结所有长尾词的特点，确定一批转化率较高的长尾词，可以作为网站的目录等，分布在首页中<br />\r\n<br />\r\n四、确定网站标题标签<br />\r\n<br />\r\n分析：在网站的定位时，已经确定了网站的关键词，然后再根据网站的关键词，填写网站标题、关键词标签、描述标签。这些都是网站优化的基础，需要注意的是，尽量将内容写的自然，关键词千万不要堆积。标题中，包括三个关键词即可<br />\r\n<br />\r\n五、完善网站布局<br />\r\n<br />\r\n分析：根据前面确定的关键词、长尾词体系，完善网站的子目录及首页的布局，包括核心关键词、近义词、同义词等，增加关键词的密度。下一章，Q猪将从分析robin的广场舞的首页，讲一下网站如何布局。<br />\r\n<br />\r\n六、构建网站结构<br />\r\n<br />\r\n分析：网站的结构尽量以扁平树形结构，具体可以看下，如何制作合理的网站结构。在构建网站结构的同时，注意URL的简单、规范。<br />\r\n<br />\r\n七、编辑网站内容<br />\r\n<br />\r\n分析：网站的内容，尽量以原创和质量较高的微原创为主，注意网站内链的建设，可以建立一份长尾词记录单，记录每一篇文章优化的关键词。<br />\r\n<br />\r\n在编辑文章内容时，注意关键词的四处一词，标题，关键词标签、描述，正文，还有网站其他页面关于帖子的锚文本。<br />\r\n<br />\r\n如果网站的内容编辑，积累到一定程度以后，可以将网站的URL提交给搜索引擎即可。然后就是外链的建设，还有网站内容的，逐步增加。<br />','','网站策划','1372261651','1','','');
INSERT INTO dou_article VALUES('6','1','新手如何选购虚拟主机','','今天给新手朋友带来一篇关于如何选购虚拟主机的文章，其实昨天下班之后就准备写的，然后今天一早发布出来，结果昨天一个新认识的朋友叫去喝酒吃饭唱歌，然后就去了，玩的也比较开心，因为认识了一大批新朋友，也希望多多认识一点在武汉搞网站方面的朋友。好了还是切入正题吧 咱们新手朋友来搞网站，首先肯定选择的是虚拟主机，但是互联网上卖虚拟主机的多余牛毛，可以简单的看下面的这个搜索“虚拟主机”的图：<br />\r\n<br />\r\n<br />\r\n5000多万了，很多SEOER接单子的时候就会根据这个相关搜索的数量来进行明码标价（虽然也不是很准确），在这么多服务商里面如何来进行选择好的，合适自己的，这个问题就会把新手朋友给搞晕，我也是个老新手，对于这个方面还是有一定经验的，今天就写下这个文章：新手如何选择虚拟主机？<br />\r\n<br />\r\n一、虚拟主机速度<br />\r\n<br />\r\n这个是我们最关心的，一般的虚拟主机服务商都有演示的IP或者站点，咱们就可以Ping它，看它的链接速度如何，一般的话国内的60MS，国外的200MS左右的话都算正常的，当然这个只是一个大方面，还需要打开站点测试一下，注意能选择双线空间最好，因为现在国内很多还是在使用网通的哦。<br />\r\n<br />\r\n&nbsp;<br />\r\n<br />\r\n二、空间稳定性<br />\r\n<br />\r\n在前面网站百度收录减少的解决方法里面我就写过网站空间稳定性对于一个网站的重要性，而且一些不良服务商会在故意这样做（这个确实是存在的），如何选择稳定的空间这个我看最好的方法还是找自己熟悉的朋友来问，毕竟使用过的才知道。而且就算同一个服务商，服务器也不同，肯定有的稳定有的也不稳定。<br />\r\n<br />\r\n三、技术服务支持<br />\r\n<br />\r\n已经说了是新手站长，那么肯定在网站方面不是很在行，或多或少出现问题，又或者网站被攻击或者什么的，总之就是会出现一些问题。哪这个时候，一个好的技术服务支持对于咱们新手来说重要性真的是太大了，这个可以选择国内知名的IDC服务商，这样才有保证。前天跟肖俊聊天的时候就谈到了这个方面的问题，因为最近他的博客遭到持续攻击，而且他是找的代理买的空间，不能直接找到万网，所以中间的处理时间就花费了非常多。唯一的好处就是代理便宜非常多，而我也经常找代理买，然后转到主机商那里，出了问题直接在线提交！<br />\r\n<br />\r\n四、主机防护或者安全性能<br />\r\n<br />\r\n最近是电商圈SEO比赛马上要结束了，但是攻击还在持续当中，昨天晚上虎子的空间就被攻击了，是万网的，因为限制流量，一下子就给他唰完了，解决方法只有换空间了，当然你可以买流量，但是攻击还是回持续撒，所以换空间能避免。扯远了，主机有很多是开的软防，也有一些开的硬防，不过就算服务器没漏洞，但是程序有问题的话，是照样会被攻击的。<br />\r\n<br />\r\n五、虚拟主机环境<br />\r\n<br />\r\n大家都知道网站程序有很多，ASP和PHP比较用的多，而数据库也分了几种，所以在程序选择上面，很多新手朋友只知道买，而不知道去选择合适自己的。ZBLOG用ASP环境的空间，而WP用PHP环境的空间（最好选择LINUX服务器），别购买了，然后去装自己程序的时候才知道自己买错了哦（虽然很多IDC服务商会跟您换，但是很麻烦哦）<br />\r\n<br />\r\n六、主机月流量<br />\r\n<br />\r\n很多主机限制了月流量，比如我这款也限制了，我在这里对新手朋友说一个我的经验：你的网站什么访问量就选择对应流量，而不是去追求选择无限制的，无限制的服务器稳定性一般都不好，试想哈，一个服务器下面很多网站，其他网站访问量高了，肯定会影响到你的网站打开速度。<br />','','如何选购虚拟主机','1372261775','12','','');
INSERT INTO dou_article VALUES('7','2','移动互联网发展下的企业网变革','','移动互联网作为桌面互联网的一个延伸和发展，是一个以宽带IP为核心技术，可为智能移动终端提供语音、视频、图像等全媒体资讯以及数据全业务服务的下一代网络。智能手机和平板电脑的快速普及、应用程序的App化互联网交付、虚拟化与云计算等技术的快速发展，促使互联网正在极快地由传统的桌面互联网向移动互联网转变。<br />\r\n<br />\r\n在全新的移动互联网时代，传统的企业IT基础架构也要进行相应变革，以更好地适应业务互联网化、移动化的需求。本文将讨论在移动互联网快速发展的背景下，新一代企业网络相较于传统的企业网络将在如下方面进行的变化：建设新一代云中心(Cloud Center)采用混合云进行业务交付、通过Wi-Fi等技术实现统一稳定的终端连接(Connectivity)，通过Internet对设备进行透明的云管理(Cloud Management)，以支撑移动互联网业务的发展。<br />\r\n　　<br />\r\nNETGEAR亚太区技术总监杨子江<br />\r\n一、移动互联网发展下的企业应用新模式<br />\r\n移动互联网时代，企业将采用虚拟化技术协同，融合公有云和私有云，以强大的混合云方式通过SaaS(软件即服务)的方式，以互联网和企业内部网络基础架构为管道，通过智能移动终端承载企业的业务应用，直面未来需求。<br />\r\n<br />\r\n接入设备<br />\r\n桌面计算机和笔记本电脑是是传统常用的终端，最近这些年来包括如以IOS、 Android、Windows Mobile为系统的各种平板电脑、智能手机以及RFID标签设备及其他移动类设备发展极为迅速。<br />\r\n<br />\r\n接入时间、地点、人物<br />\r\n移动互联网环境下，工作人员摆脱了只有在固定地点、固定时间才能进行业务应用的局限,他们可以随时随地进行移动办公，任何人、任何设备、任何地点安全地运行在任何网络之上，这是以往以PC为基础的桌面互联网时代所未有的简单方便的接入。<br />\r\n<br />\r\n接入方式<br />\r\n移动互联网发展下企业网络常见有三种主流的终端联网方式：Wi-Fi无线接入(无线局域网)、3G/4G移动网络(无线广域网)、有线以太网接入(有线局域网)。<br />\r\n<br />\r\n应用 APP化<br />\r\n企业网的各种业务应用APP化，以互联网和企业内部的局域网络为管道，以移动终端为载体进行业务交付的模式已成为大趋势。<br />','','移动互联网发展下的企业网变革','1372261909','2','','');
INSERT INTO dou_article VALUES('8','2','企业网站文章标题该如何去撰写','','企业网站撰写文章目的是为什么?首先要请我们编辑或者是优化的人员想一想。如果你说只是为了更新，为了网站收录，获得搜索引擎的青睐。其实你错了，你已经走入了一个误区，那就是文章并不是给搜索引擎看的，而是给用户看。下面看单仁资讯先为你列出目前存在的一些误区，之后再提出一些建议。<br />\r\n<br />\r\n误区一：文章标题需要很吸引眼球<br />\r\n<br />\r\n有人就说了，文章标题是一篇文章是否成功的一半，只有文章标题好才能够吸引点击。其实这个说的是没错，但是这对于企业网站并不适合。试想用户到你网站难道就是去看文章的?当然不是。一般用户是有疑问或者需要解决什么问题，所以再去搜索，之后才会进入你的网站。当然你网站首页关键词是有限，所以还是需要靠文章或者产品的长尾词来进行扩充，这部分才是流量的主力军。就如“英特尔手机“农村包围城市”，就等厂商进来”虽然很吸引眼球但这样的标题用户会去搜索吗?反之在企业网站中我们就不应该进入这样的思维误区。<br />\r\n<br />\r\n误区二：标题很学术<br />\r\n<br />\r\n标题很学术，对于企业网站行不通。我们时刻应该要知道的就是企业文章是一种宣传，更是一种获取流量的最大的源泉。除非你的网站很知名，要不别人是不会进入你的网站，这个时候我们就需要通过一些解决用户，给用户提供比较有见解的文章来吸引用户。所以我们的标题也不能很学术，只需要站在一个用户的角度来思考问题即可。<br />\r\n<br />\r\n建议：<br />\r\n<br />\r\n一：企业文章标题是吸引用户点击进来，也是用户搜索进入的第一个接口，我们不能只考虑到吸引，但是没有想到是否有用户去搜索。企业写文章主要应该是站在用户的角度，帮助用户解决问题，这样这篇文章才会被人搜索到，才会有价值的存在。比如“企业如何做好网络营销”这个文章标题不是那么的夺目，但是会给用户解决问题，能够告诉用户怎么去做网络营销，当有不知道的如何去做网络营销的用户，就会有去搜索，当你能够解决他的问题，这样这篇文章才是成功的。<br />\r\n<br />\r\n二：标题需要直白而且用户常搜索，标题写的好，但是没人搜索，也就没人去看你这篇文章。所以我们应该需要直白的标题，还有就是组合用户常搜索的关键词。这样就会当用户搜索的时候搜索引擎就会判断，当你标题中含有用户搜索的关键词，这个时候也就会排名靠前。<br />\r\n<br />\r\n　　所以作为一名编辑，我们不能够只是站在自己的角度来写文章标题，我们应该是站在用户的角度来撰写标题。对于一家企业来说，我们在互联网上要想获得客户，我们就需要从细节出发，就如文章的标题，我们都需要考虑很多。只有全面，够系统，网站才能够真正的成为金牌业务员。<br />','','企业网站文章标题该如何去撰写','1372261997','0','','');
INSERT INTO dou_article VALUES('9','2','详解如何利用RSS进行网络推广','','网络推广方法有很多，RSS推广就是其中的一种，RSS订阅能够为网站增加访问量，这是众人皆知的事实。不过，如何推广RSS，让更多人知道并促使更多人订阅RSS，却是一个很大的问题。下面就有我给大家讲解一下什么事RSS推广，如何利用RSS进行网络推广。<br />\r\n<br />\r\n首先来说说什么是RSS？<br />\r\n<br />\r\nRSS是在线共享内容的一种简单方式（也叫聚合内容，Really Simple Syndication）。通常在时效性比较强的内容上使用RSS订阅能更快速获取信息。网站提供RSS输出，有利于让用户获取网站内容的最新信息。网络用户可以在客户端借助于支持RSS的聚合工具软件（如SharpReader，NwezCrawler，FeedDemon），在不打开网站内容页面的情况下阅读支持RSS输出的网站内容。<br />\r\n<br />\r\n那么RSS有什么用途呢？<br />\r\n<br />\r\n订阅BLOG，可以订阅工作中所需的技术文章，也可以订阅与你有共同爱好的作者的Blog，总之，对什么感兴趣就可以订什么。<br />\r\n<br />\r\n订阅新闻，无论是奇闻怪事、明星消息、体坛风云，只要你想知道的，都可以订阅。<br />\r\n<br />\r\n你再也不用一个网站一个网站，一个网页一个网页去逛了。只要这将你需要的内容订阅在一个RSS阅读器中，这些内容就会自动出现你的阅读器里，你也不必为了一个急切想知道的消息而不断的刷新网页，因为一旦有了更新，RSS阅读器就会自己通知你。<br />\r\n<br />\r\n什么是RSS推广？<br />\r\n<br />\r\nRSS推广即指利用RSS这一互联网工具传递营销信息的网络营销推广模式。RSS推广通常是与EDM（电子邮件营销）配合使用的。因为RSS的特点比EDM具有更多的优势，可以对后者进行替代和补充。且RSS与EDM也有许多相似之处，它们之间的根本区别是向用户传递有价值信息的方式不同。RSS和EDM相比，主要有一下几个有点：<br />\r\n<br />\r\n1、多样性、个性化信息的聚合。RSS是一种基于XML（Extensible Markup Language，扩展性标识语言）标准，是一种互联网上被广泛采用的内容包装和投递协议，任何内容源都可以采用这种方式来发布，包括专业新闻、网络营销、企业、甚至个人等站点。若在用户端安装了RSS阅读器软件，用户就可以按照喜好、有选择性地将感兴趣的内容来源聚合到该软件的界面中，为用户提供多来源信息的“一站式”服务。<br />\r\n<br />\r\n2、信息发布的时效强、成本低廉。由于用户端RSS阅读器中的信息是随着订阅源信息的更新而及时更新的，所以极大地提高了信息的时效性和价值。此外，服务器端信息的RSS包装在技术实现上极为简单，而且是一次性的工作，使长期的信息发布边际成本几乎降为零，这完全是传统的电子邮件、互联网浏览等发布方式所无法比拟的。<br />\r\n<br />\r\n3、无“垃圾”信息和信息量过大的问题。RSS阅读器中的信息是完全由用户订阅的，对于用户没有订阅的内容，以及弹出式广告、垃圾邮件等无关信息则会被完全屏蔽掉。因而不会有令人烦恼的“噪音”干扰。此外，在用户端获取信息并不需要专用的类似电子邮箱那样的“RSS 信箱”来存储，因而不必担心信息内容的过大问题。<br />\r\n<br />\r\n4、没有病毒邮件的影响。在RSS阅读器中保存的只是所订阅信息的摘要，要查看其详细内容与到网站上通过浏览器阅读没有太大差异，因而不必担心病毒邮件的危害。<br />\r\n<br />\r\n5、本地内容管理便利。对下载到RSS阅读器里订阅内容，用户可以进行离线阅读、存档保留、搜索排序及相关分类等多种管理操作，使阅读器软件不仅是一个“阅读”器，而且还是一个用户随身的“资料库”。<br />\r\n<br />\r\n虽然RSS的有点很多，但是缺点也很明显。RSS营销的定位性不如EDM强，我们很难主动选择让谁订阅我们的RSS，因此RSS很难实现个性化营销。同时RSS也不容易做到像EDM那样跟踪营销的效果。<br />\r\n<br />\r\n总之，RSS与EDM相比具有很大的优势，特别是克服了EDM中常出现的垃圾邮件、病毒、信息即时性差等致命缺点，因而将有力地促进RSS的推广应用。所以，网络推广者者一定要加以足够地重视，以增强自己的竞争优势。当然RSS营销模式还有很多的问题要面对，对于如何有效地利用更需深入地研究探讨。<br />\r\n<br />\r\n前面说过RSS推广处于刚起步阶段，是一种新式的网络推广方法，下面我在介绍一下RSS推广实战操作的方法，主要有以下几种简单方法：<br />\r\n<br />\r\n1、提交RSS<br />\r\n<br />\r\n提交到哪里呢？网络上有很多专门针对RSS的搜索引擎和RSS分类目录，我们贺姨将网站的RSS提交给这些站点。这样不仅可以促进搜索引擎收录、增加RSS曝光率，还能为网站增加链接广度；既可以带来流量，又能加快搜索引擎收录与信息的推广。<br />\r\n<br />\r\n2、RSS图标<br />\r\n<br />\r\n有条件的话给你的网站增加RSS订阅吧，并将网站RSS订阅图标放在醒目的位置。<br />\r\n<br />\r\n3、量身定制内容<br />\r\n<br />\r\n针对不同的用户推送不同的内容，让用户愿意去订阅他们想要的内容。<br />\r\n<br />\r\n4、邮件中增加RSS订阅链接<br />\r\n<br />\r\n一种不错的病毒式推广，一方面是EDM的补充，随着网民网龄的增加，使用RSS代替EDM的会越来越多。<br />\r\n<br />\r\n5、多功能应用<br />\r\n<br />\r\n比如让用户通过RSS订阅的方式获取天气预报、订阅感兴趣的分类广告信息，网络商城还可以用它来传递物流跟踪信息、传递商品打折通知、拍卖商品的实时竞价情况等等。<br />','','详解如何利用RSS进行网络推广','1372262040','8','详解如何利','');
INSERT INTO dou_article VALUES('10','1','移动互联网产品设计的核心要素有哪些？','','移动互联网和传统互联网的设计有很多不同<br />\r\n<br />\r\n移动互联网和传统互联网的设计有很多不同，针对前者有哪些关键的设计重点、考虑要素、交互或体验要特别注意的呢？本文来自知乎网友可风的回答。<br />\r\n<br />\r\n可风<br />\r\n<br />\r\n最近越来越多的圈内人开始随大潮进入移动互联网领域，从传统的web或者桌面端设计开始学习移动互联网产品的设计。在很多人眼里，设计移动互联网产品和传统互联网产品的区别无非就是载体从电脑变成了手机，所以只要熟悉一下各个手机中不同的规范和特性就算是完成了过渡，学习了下ios human guideline，了解了一下拟物化设计和扁平化设计，就以为是了解了移动互联网的设计方法。其实这种思想完全是只看到表现而没看到本质的错误，移动互联网和传统互联网的区别不光是设计标准和设计规范的变化，而应该从整个物理环境的变化来重新全面的认识。那么我们分析一下，移动互联网产品的用户体验和传统互联网产品有什么区别呢？<br />\r\n<br />\r\n一、使用场景的复杂<br />\r\n<br />\r\n用户在使用桌面客户端或者访问web页面的时候，多半是坐在电脑前，固定的盯着屏幕和使用键鼠操作，这个时候对于用户来说，使用场景是简单而固定的。但是在使用手机的时候，用户可能在地铁中，在公交上，在电梯中，无聊等待时或者边走路边用。如此复杂的场景，需要产品的设计者考虑的要素也自然非常的复杂。<br />\r\n<br />\r\n比如在公交车上拥挤和摇晃时，用户如果才能顺畅的单手操作？比如在地铁或者电梯的信号不好的情况下，是否要考虑各种网络情况带来的问题？比如用户在无聊等待玩游戏，或者在床上睡前时，又变成了深入沉浸的体验？不同的场景不同的情况在设计时是否都有考虑清楚？<br />\r\n<br />\r\n二、使用时间碎片化<br />\r\n<br />\r\n用户在使用电脑时，大部分时间还是固定的，无非可能因为工作和同事沟通一下，或者起身上个厕所，一般都有10-20分钟完整的时间片在操作电脑。但是移动端就不一样了，用户既然在移动，使用手机时要随时随地观察周围的情况，随时可能中断现在的操作，锁屏，再继续刚才的操作。所以用户使用移动产品的时间不是连成片的，而是一段一段的，有的时候中断回再回来，有的时候中断就不会回来了。<br />\r\n<br />\r\n三、屏幕尺寸的缩小<br />\r\n<br />\r\n用户使用电脑产品的屏幕尺寸是可以很大的，小则13寸大到27寸，这样使得桌面产品和web产品有充足的区域展现信息，整个界面利用率就可以很高。我们在做交互设计的时候会有一种方法，如果一个次要信息的出现不会影响大部分用户的时候，那么这个次要信息是可以放在界面上的，这就是为什么网站可以加入很多广告banner的原因，因为只要保持到一个度不影响正常的使用就不会破坏整体的用户体验。但是在移动端，这个度是非常的小的，因为屏幕尺寸的限制，本身需要你展现的必要信息都需要有一个合理的规划和抉择，次要的信息再一出来肯定破坏体验。将前2条结合你会发现，用户在使用移动产品是需要非常追求效率的，所以移动端产品的设计难道会大大增加。<br />\r\n<br />\r\n四、无法多任务的处理信息<br />\r\n<br />\r\n用户在使用桌面产品时，是更加容易的进行多任务操作和处理的，比如我正在浏览web查资料，又正在进行文档的整理，还可能开着QQ和朋友聊天。因为大屏幕的关系和系统机制让用户能够高效的同时处理多个信息，当然，还得益于固定的使用场景和完整的时间片。但是因为前面也提到的问题，移动端的产品往往是沉浸式的，用户在同一时期只可能使用一个应用，完成一个流程，然后结束，再去开启另一个应用和另一个流程，所以大部分移动产品设计时往往讲求遵循的是单一的任务流，期间结束和跳转的设计非常的少。<br />\r\n<br />\r\n五、平台的设计规范和特性<br />\r\n<br />\r\n最后才是各自的平台规范和标准，比如什么ios human guideline或者WindowsPhone的metro理念，纵观知乎和各大网站，很多人每天关注的都是这些比如拟物化设计和扁平化设计的风格，返回按钮的逻辑或者隐藏title之类的方法论细节。的确你了解这些信息是可以快速方便的设计出一个可用的移动产品的，但是如果没有了解之前所说的几条移动产品和传统互联网产品在用户体验上的区别，你可能永远也无法参透移动互联网用户体验的规律和本质。<br />','','移动互联网','1372262079','99','','');

DROP TABLE IF EXISTS dou_article_category;
CREATE TABLE `dou_article_category` (
  `cat_id` smallint(5) NOT NULL auto_increment,
  `unique_id` varchar(30) NOT NULL default '',
  `cat_name` varchar(255) NOT NULL default '',
  `keywords` varchar(255) NOT NULL default '',
  `description` varchar(255) NOT NULL default '',
  `parent_id` smallint(5) NOT NULL default '0',
  `sort` tinyint(1) unsigned NOT NULL default '50',
  PRIMARY KEY  (`cat_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO dou_article_category VALUES('1','company','公司动态','公司动态','公司的最新新闻在此发布','0','10');
INSERT INTO dou_article_category VALUES('2','industry','行业新闻','行业新闻','最新行业资讯','0','20');

DROP TABLE IF EXISTS dou_config;
CREATE TABLE `dou_config` (
  `name` varchar(80) NOT NULL,
  `value` text NOT NULL,
  `type` varchar(10) NOT NULL default '',
  `box` varchar(255) NOT NULL default '',
  `tab` varchar(10) NOT NULL default 'main',
  `sort` tinyint(3) unsigned NOT NULL default '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO dou_config VALUES('site_name','DouPHP轻量级企业网站管理系统','text','','main','1');
INSERT INTO dou_config VALUES('site_title','DouPHP轻量级企业网站管理系统','text','','main','2');
INSERT INTO dou_config VALUES('site_keywords','DouPHP,轻量级企业网站管理系统','text','','main','3');
INSERT INTO dou_config VALUES('site_description','DouPHP,轻量级企业网站管理系统','text','','main','4');
INSERT INTO dou_config VALUES('site_theme','default','select','','main','5');
INSERT INTO dou_config VALUES('site_logo','logo.gif','file','','main','6');
INSERT INTO dou_config VALUES('site_address','福建省漳州市芗城区','text','','main','7');
INSERT INTO dou_config VALUES('site_closed','0','radio','','main','8');
INSERT INTO dou_config VALUES('icp','','text','','main','9');
INSERT INTO dou_config VALUES('tel','0596-8888888','text','','main','10');
INSERT INTO dou_config VALUES('fax','0596-6666666','text','','main','11');
INSERT INTO dou_config VALUES('qq','','text','','main','12');
INSERT INTO dou_config VALUES('email','your@domain.com','text','','main','13');
INSERT INTO dou_config VALUES('language','zh_cn','select','','main','14');
INSERT INTO dou_config VALUES('rewrite','1','radio','','main','15');
INSERT INTO dou_config VALUES('sitemap','1','radio','','main','16');
INSERT INTO dou_config VALUES('captcha','1','radio','','main','17');
INSERT INTO dou_config VALUES('guestbook_check_chinese','1','radio','','main','18');
INSERT INTO dou_config VALUES('code','','textarea','','main','19');
INSERT INTO dou_config VALUES('display_product','10','text','','display','1');
INSERT INTO dou_config VALUES('display_article','10','text','','display','2');
INSERT INTO dou_config VALUES('display_guestbook','10','text','','display','3');
INSERT INTO dou_config VALUES('home_display_product','4','text','','display','4');
INSERT INTO dou_config VALUES('home_display_article','5','text','','display','5');
INSERT INTO dou_config VALUES('thumb_width','135','text','','display','6');
INSERT INTO dou_config VALUES('thumb_height','135','text','','display','7');
INSERT INTO dou_config VALUES('price_decimal','2','text','','display','8');
INSERT INTO dou_config VALUES('defined_product','','text','','defined','1');
INSERT INTO dou_config VALUES('defined_article','','text','','defined','2');
INSERT INTO dou_config VALUES('mobile_name','DouPHP','text','','mobile','1');
INSERT INTO dou_config VALUES('mobile_title','DouPHP触屏版','text','','mobile','2');
INSERT INTO dou_config VALUES('mobile_keywords','DouPHP,DouPHP触屏版','text','','mobile','3');
INSERT INTO dou_config VALUES('mobile_description','DouPHP,DouPHP触屏版','text','','mobile','4');
INSERT INTO dou_config VALUES('mobile_theme','default','select','','mobile','5');
INSERT INTO dou_config VALUES('mobile_logo','','file','','mobile','6');
INSERT INTO dou_config VALUES('mobile_display_product','10','text','','mobile','7');
INSERT INTO dou_config VALUES('mobile_display_article','10','text','','mobile','8');
INSERT INTO dou_config VALUES('mobile_display_guestbook','10','text','','mobile','9');
INSERT INTO dou_config VALUES('mobile_home_display_product','6','text','','mobile','10');
INSERT INTO dou_config VALUES('mobile_home_display_article','6','text','','mobile','11');
INSERT INTO dou_config VALUES('build_date','1377768032','hidden','','','100');
INSERT INTO dou_config VALUES('hash_code','166d0de32dafdef9ab26e10130dd115b','hidden','','','101');
INSERT INTO dou_config VALUES('douphp_version','v1.2 Release 20141130','hidden','','','102');

DROP TABLE IF EXISTS dou_guestbook;
CREATE TABLE `dou_guestbook` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `title` varchar(150) NOT NULL default '',
  `name` varchar(60) NOT NULL default '',
  `contact_type` varchar(30) NOT NULL default '',
  `contact` varchar(150) NOT NULL default '',
  `content` text NOT NULL,
  `if_show` tinyint(1) NOT NULL default '0',
  `if_read` tinyint(1) NOT NULL default '0',
  `ip` varchar(15) NOT NULL default '',
  `add_time` int(10) unsigned NOT NULL default '0',
  `reply_id` smallint(5) NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS dou_link;
CREATE TABLE `dou_link` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `link_name` varchar(60) NOT NULL default '',
  `link_url` varchar(255) NOT NULL default '',
  `sort` tinyint(1) unsigned NOT NULL default '50',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO dou_link VALUES('1','豆壳网络','http://www.douco.com','127');

DROP TABLE IF EXISTS dou_nav;
CREATE TABLE `dou_nav` (
  `id` mediumint(8) NOT NULL auto_increment,
  `module` varchar(20) NOT NULL,
  `nav_name` varchar(255) NOT NULL,
  `guide` varchar(255) NOT NULL,
  `parent_id` smallint(5) NOT NULL default '0',
  `type` varchar(10) NOT NULL,
  `sort` tinyint(1) unsigned NOT NULL default '50',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

INSERT INTO dou_nav VALUES('1','page','公司简介','1','0','middle','10');
INSERT INTO dou_nav VALUES('2','page','企业荣誉','2','1','middle','10');
INSERT INTO dou_nav VALUES('3','page','发展历程','3','1','middle','20');
INSERT INTO dou_nav VALUES('4','page','联系我们','4','1','middle','30');
INSERT INTO dou_nav VALUES('5','product_category','产品中心','0','0','middle','20');
INSERT INTO dou_nav VALUES('6','article_category','文章中心','0','0','middle','30');
INSERT INTO dou_nav VALUES('7','page','营销网络','6','0','middle','40');
INSERT INTO dou_nav VALUES('8','page','人才招聘','5','0','middle','60');
INSERT INTO dou_nav VALUES('9','page','联系我们','4','0','middle','70');
INSERT INTO dou_nav VALUES('10','product_category','电子数码','1','5','middle','10');
INSERT INTO dou_nav VALUES('11','product_category','家居百货','2','5','middle','20');
INSERT INTO dou_nav VALUES('12','product_category','母婴用品','3','5','middle','30');
INSERT INTO dou_nav VALUES('13','article_category','公司动态','1','6','middle','10');
INSERT INTO dou_nav VALUES('14','article_category','行业新闻','2','6','middle','20');
INSERT INTO dou_nav VALUES('15','page','企业荣誉','2','0','middle','50');
INSERT INTO dou_nav VALUES('17','page','公司简介','1','0','bottom','10');
INSERT INTO dou_nav VALUES('18','page','营销网络','6','0','bottom','20');
INSERT INTO dou_nav VALUES('19','page','企业荣誉','2','0','bottom','30');
INSERT INTO dou_nav VALUES('20','page','人才招聘','5','0','bottom','40');
INSERT INTO dou_nav VALUES('21','page','联系我们','4','0','bottom','50');
INSERT INTO dou_nav VALUES('22','product_category','智能手机','4','10','middle','1');
INSERT INTO dou_nav VALUES('23','product_category','平板电脑','5','10','middle','2');
INSERT INTO dou_nav VALUES('24','guestbook','留言反馈','0','0','top','20');
INSERT INTO dou_nav VALUES('25','page','公司简介','1','0','mobile','10');
INSERT INTO dou_nav VALUES('26','product_category','产品中心','0','0','mobile','20');
INSERT INTO dou_nav VALUES('27','article_category','文章中心','0','0','mobile','30');
INSERT INTO dou_nav VALUES('28','page','企业荣誉','2','0','mobile','40');
INSERT INTO dou_nav VALUES('29','page','营销网络','6','0','mobile','50');
INSERT INTO dou_nav VALUES('30','page','人才招聘','5','0','mobile','60');
INSERT INTO dou_nav VALUES('31','page','联系我们','4','0','mobile','70');
INSERT INTO dou_nav VALUES('32','guestbook','留言反馈','0','0','mobile','80');
INSERT INTO dou_nav VALUES('33','mobile','手机版','0','0','top','10');
INSERT INTO dou_nav VALUES('34','mobile','手机版','0','0','bottom','60');

DROP TABLE IF EXISTS dou_page;
CREATE TABLE `dou_page` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `unique_id` varchar(30) NOT NULL default '',
  `parent_id` smallint(5) NOT NULL default '0',
  `page_name` varchar(150) NOT NULL default '',
  `content` longtext NOT NULL,
  `keywords` varchar(255) NOT NULL default '',
  `description` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

INSERT INTO dou_page VALUES('1','about','0','公司简介','DouPHP 是一款轻量级企业网站管理系统，基于PHP+Mysql架构的，可运行在Linux、Windows、MacOSX、Solaris等各种平台上，系统搭载Smarty模板引擎，支持自定义伪静态，前台模板采用DIV+CSS设计，后台界面设计简洁明了，功能简单易具有良好的用户体验，稳定性好、扩展性及安全性强，可面向中小型站点提供网站建设解决方案。','公司简介','公司简介');
INSERT INTO dou_page VALUES('2','honor','1','企业荣誉','企业荣誉','企业荣誉','企业荣誉');
INSERT INTO dou_page VALUES('3','history','1','发展历程','发展历程','发展历程','发展历程');
INSERT INTO dou_page VALUES('4','contact','1','联系我们','通讯地址：<br />\r\n<span style=\"color:#D7D7D7;\">--------------------------------------------------------------------------------------------------------------------------------</span><br />\r\n福建省漳州市芗城区，邮编363000<br />\r\n<br />\r\n客服邮箱：<br />\r\n<span style=\"color:#D7D7D7;\">--------------------------------------------------------------------------------------------------------------------------------</span><br />\r\nDouPHP售后服务邮箱：email@email.com<br />\r\nDouPHP业务受理邮箱：<span>email@email.com</span><br />\r\n如您需要订制开发请在邮件中注明您的大概要求，我们将在一个工作日内给予回复。<br />\r\n<br />\r\n客服电话：<br />\r\n<span style=\"color:#D7D7D7;\">--------------------------------------------------------------------------------------------------------------------------------</span><br />\r\n<span>DouPHP</span>的建站咨询电话为 0596-1234567。<br />\r\n客服电话工作时间为周一至周日 8:00-20:00，节假日不休息，免长途话费。<br />\r\n我们将随时为您献上真诚的服务。<br />\r\n<br />\r\n网站网址：<br />\r\n<span style=\"color:#D7D7D7;\">--------------------------------------------------------------------------------------------------------------------------------</span><br />\r\nwww.douco.com<br />','联系我们','联系我们');
INSERT INTO dou_page VALUES('5','job','0','人才招聘','人才招聘','人才招聘','人才招聘');
INSERT INTO dou_page VALUES('6','market','0','营销网络','营销网络','营销网络','营销网络');

DROP TABLE IF EXISTS dou_product;
CREATE TABLE `dou_product` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `cat_id` smallint(5) NOT NULL default '0',
  `product_name` varchar(150) NOT NULL default '',
  `price` decimal(10,2) unsigned NOT NULL default '0.00',
  `defined` text NOT NULL,
  `content` longtext NOT NULL,
  `product_image` varchar(255) NOT NULL default '',
  `keywords` varchar(255) NOT NULL default '',
  `add_time` int(10) unsigned NOT NULL default '0',
  `description` varchar(255) NOT NULL default '',
  `home_sort` varchar(2) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

INSERT INTO dou_product VALUES('1','5','iPad平板电脑','3680.00','','iPad，是一款苹果公司于2010年发布的平板电脑，定位介于苹果的智能手机iPhone和笔记本电脑产品之间，通体只有四个按键，与iPhone布局一样，提供浏览互联网、收发电子邮件、观看电子书、播放音频或视频、玩游戏等功能。<br />\r\n<br />\r\n据XDA科技报道，上游供应链知情人士透露，因mini版iPad全球销量强劲，苹果已经将这款平板电脑的订单由此前的800万增加至1000万，并预期到2012年年底，mini[1]版iPad的全球出货量有望达到1200万部[2]。<br />\r\n<br />\r\niPad在欧美称网络阅读器，国内俗称“平板电脑”。 具备浏览网页、收发邮件、普通视频文件播放、音频文件播放、一些简单游戏等基本的多媒体功能。由于采用ARM架构，不能兼容普通PC台式机和笔记本的程序，不具备办公的能力，但可以通过安装第三方软件来实现对OFFICE系列文件的阅读和简单编辑。iPad有只能用wifi上网的版本，也有wifi和3G上网都支持的版本。<br />\r\n<br />\r\n苹果iPad是由英国出生的设计主管乔纳森·伊夫（Jonathan Ive）（有些翻译为 乔纳森·艾维）领导的团队设计的，这个圆滑、超薄的产品反映出了伊夫对德国天才设计师Dieter Ram的崇敬之情。<br />\r\n<br />\r\n英文名：iPad的书写也是有讲究的。字母“p”本来是小写的，但是如果是小写的“p”按照英语的书写规则，就会看到“p”伸出了一条腿，像是多出了一块，不整齐。所以iPad就把原本小写的“p”换成了大写的“P”，视觉上感觉更加的美观。全世界都在给iPad做广告，不是没道理的。注重细节，重视用户体验，是伟大品牌的共同特质。<br />','images/product/1.jpg','ipad,平板电脑','1372244512','','');
INSERT INTO dou_product VALUES('2','4','苹果iPhone 5手机','5300.00','','iPhone 是结合照相手机、个人数码助理、媒体播放器以及无线通信设备的掌上智能手机，由史蒂夫·乔布斯在2007年1月9日举行的Macworld宣布推出，2007年6月29日在美国上市。iPhone是一部4频段的GSM制式手机，支持EDGE和802.11b/g无线上网，支持电邮、移动通话、短信、网络浏览以及其他的无线通信服务。2007年6月29日18:00 iPhone（即iphone1代） 在美国上市，2008年7月11日，苹果公司推出3G iPhone。2010年6月8日凌晨1点乔布斯发布了 iPhone 4 。2011年10月5日凌晨，iPhone 4S 发布。2012年9月13日凌晨（美国时间9月12日上午）iPhone 5 发布。苹果公司将从2013年6月拟在美启动一项iPhone手机以旧换新计划，旨在让更多的老机型用户升级到iPhone5，并交还老机型。<br />\r\n<br />\r\n<p>\r\n	iPhone包括了iPod的媒体播放功能，和为了移动设备修改后的Mac OS X操作系统（iOS，本名iPhone OS，自4.0版本起改名为iOS)，以及800万像素的摄像头。（一代、二代为200万，3GS为320万，支持自动对焦，4代提升到背照式500万，而2011年发布的4S提升到800万并且采用2.4f大光圈）此外，设备内置有重力感应器，iphone4有三轴陀螺仪（三轴方向重力感应器），能依照用户水平或垂直的持用方式，自动调整屏幕显示方向。并且内置了光感器，支持根据当前光线强度调整屏幕亮度。还内置了距离感应器，防止在接打电话时，耳朵误触屏幕引起的操作。2012年9月发布的iPhone4S、5更是加入了一个全新的拍照模式——全景模式，在该模式下可以用iPhone 4S、5拍摄全景照片，全景照片可达2800万像素。\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<table class=\"table-view log-set-param\" style=\"margin:5px 0px;font-size:12px;color:#000000;font-family:arial, 宋体, sans-serif;background-color:#FFFFFF;\">\r\n		<tbody>\r\n			<tr>\r\n				<td width=\"100\" align=\"left\" valign=\"center\" height=\"0\" style=\"border:1px solid #DCDEE0;\">\r\n					<div class=\"para\">\r\n						手机名\r\n					</div>\r\n				</td>\r\n				<td width=\"590\" align=\"left\" valign=\"center\" height=\"0\" style=\"border:1px solid #DCDEE0;\">\r\n					<div class=\"para\">\r\n						iPhone 5\r\n					</div>\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td width=\"100\" align=\"left\" valign=\"center\" height=\"0\" style=\"border:1px solid #DCDEE0;\">\r\n					<div class=\"para\">\r\n						发布时间\r\n					</div>\r\n				</td>\r\n				<td width=\"590\" align=\"left\" valign=\"center\" height=\"0\" style=\"border:1px solid #DCDEE0;\">\r\n					<div class=\"para\">\r\n						2012年9月12日\r\n					</div>\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td width=\"100\" align=\"left\" valign=\"center\" height=\"0\" style=\"border:1px solid #DCDEE0;\">\r\n					<div class=\"para\">\r\n						内存容量\r\n					</div>\r\n				</td>\r\n				<td width=\"590\" align=\"left\" valign=\"center\" height=\"0\" style=\"border:1px solid #DCDEE0;\">\r\n					<div class=\"para\">\r\n						内置存储：16GB/32GB/64GB\r\n					</div>\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td width=\"100\" align=\"left\" valign=\"center\" height=\"0\" style=\"border:1px solid #DCDEE0;\">\r\n					<div class=\"para\">\r\n						处理器\r\n					</div>\r\n				</td>\r\n				<td width=\"590\" align=\"left\" valign=\"center\" height=\"0\" style=\"border:1px solid #DCDEE0;\">\r\n					<div class=\"para\">\r\n						800 MHz-1.3 GHz 双核 Apple A6\r\n					</div>\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td width=\"100\" align=\"left\" valign=\"center\" height=\"0\" style=\"border:1px solid #DCDEE0;\">\r\n					<div class=\"para\">\r\n						屏幕\r\n					</div>\r\n				</td>\r\n				<td width=\"590\" align=\"left\" valign=\"center\" height=\"0\" style=\"border:1px solid #DCDEE0;\">\r\n					<div class=\"para\">\r\n						4.0英寸，1136x640分辨率\r\n					</div>\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td width=\"100\" align=\"left\" valign=\"center\" height=\"0\" style=\"border:1px solid #DCDEE0;\">\r\n					<div class=\"para\">\r\n						主相机\r\n					</div>\r\n				</td>\r\n				<td width=\"590\" align=\"left\" valign=\"center\" height=\"0\" style=\"border:1px solid #DCDEE0;\">\r\n					<div class=\"para\">\r\n						800万像素，f/2.4\r\n					</div>\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td width=\"100\" align=\"left\" valign=\"center\" height=\"0\" style=\"border:1px solid #DCDEE0;\">\r\n					<div class=\"para\">\r\n						前置相机\r\n					</div>\r\n				</td>\r\n				<td width=\"590\" align=\"left\" valign=\"center\" height=\"0\" style=\"border:1px solid #DCDEE0;\">\r\n					<div class=\"para\">\r\n						120万像素\r\n					</div>\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td width=\"100\" align=\"left\" valign=\"center\" height=\"0\" style=\"border:1px solid #DCDEE0;\">\r\n					<div class=\"para\">\r\n						录像\r\n					</div>\r\n				</td>\r\n				<td width=\"590\" align=\"left\" valign=\"center\" height=\"0\" style=\"border:1px solid #DCDEE0;\">\r\n					<div class=\"para\">\r\n						1080p（1920×1080，30帧/秒）视频录制\r\n					</div>\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td width=\"100\" align=\"left\" valign=\"center\" height=\"0\" style=\"border:1px solid #DCDEE0;\">\r\n					<div class=\"para\">\r\n						操作系统\r\n					</div>\r\n				</td>\r\n				<td width=\"590\" align=\"left\" valign=\"center\" height=\"0\" style=\"border:1px solid #DCDEE0;\">\r\n					<div class=\"para\">\r\n						iOS 6.0(可升级至iOS 6.1.4)\r\n					</div>\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td width=\"100\" align=\"left\" valign=\"center\" height=\"0\" style=\"border:1px solid #DCDEE0;\">\r\n					<div class=\"para\">\r\n						移动通信\r\n					</div>\r\n				</td>\r\n				<td width=\"590\" align=\"left\" valign=\"center\" height=\"0\" style=\"border:1px solid #DCDEE0;\">\r\n					<div class=\"para\">\r\n						GSM，CDMA2000，LTE，WCDMA\r\n					</div>\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td width=\"100\" align=\"left\" valign=\"center\" height=\"0\" style=\"border:1px solid #DCDEE0;\">\r\n					<div class=\"para\">\r\n						Wi-Fi\r\n					</div>\r\n				</td>\r\n				<td width=\"590\" align=\"left\" valign=\"center\" height=\"0\" style=\"border:1px solid #DCDEE0;\">\r\n					<div class=\"para\">\r\n						有\r\n					</div>\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td width=\"100\" align=\"left\" valign=\"center\" height=\"0\" style=\"border:1px solid #DCDEE0;\">\r\n					<div class=\"para\">\r\n						传感器\r\n					</div>\r\n				</td>\r\n				<td width=\"590\" align=\"left\" valign=\"center\" height=\"0\" style=\"border:1px solid #DCDEE0;\">\r\n					<div class=\"para\">\r\n						加速传感器、指南针、陀螺仪、距离传感器\r\n					</div>\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td width=\"100\" align=\"left\" valign=\"center\" height=\"0\" style=\"border:1px solid #DCDEE0;\">\r\n					<div class=\"para\">\r\n						FaceTime\r\n					</div>\r\n				</td>\r\n				<td width=\"590\" align=\"left\" valign=\"center\" height=\"0\" style=\"border:1px solid #DCDEE0;\">\r\n					<div class=\"para\">\r\n						有\r\n					</div>\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td width=\"100\" align=\"left\" valign=\"center\" height=\"0\" style=\"border:1px solid #DCDEE0;\">\r\n					<div class=\"para\">\r\n						蓝牙\r\n					</div>\r\n				</td>\r\n				<td width=\"590\" align=\"left\" valign=\"center\" height=\"0\" style=\"border:1px solid #DCDEE0;\">\r\n					<div class=\"para\">\r\n						有 Bluetooth 4.0\r\n					</div>\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td width=\"100\" align=\"left\" valign=\"center\" height=\"0\" style=\"border:1px solid #DCDEE0;\">\r\n					<div class=\"para\">\r\n						内存\r\n					</div>\r\n				</td>\r\n				<td width=\"590\" align=\"left\" valign=\"center\" height=\"0\" style=\"border:1px solid #DCDEE0;\">\r\n					<div class=\"para\">\r\n						1GB DRAM\r\n					</div>\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td width=\"100\" align=\"left\" valign=\"center\" height=\"0\" style=\"border:1px solid #DCDEE0;\">\r\n					<div class=\"para\">\r\n						机身存储\r\n					</div>\r\n				</td>\r\n				<td width=\"590\" align=\"left\" valign=\"center\" height=\"0\" style=\"border:1px solid #DCDEE0;\">\r\n					<div class=\"para\">\r\n						16GB 32GB 64GB\r\n					</div>\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td width=\"100\" align=\"left\" valign=\"center\" height=\"0\" style=\"border:1px solid #DCDEE0;\">\r\n					<div class=\"para\">\r\n						SIM 标准\r\n					</div>\r\n				</td>\r\n				<td width=\"590\" align=\"left\" valign=\"center\" height=\"0\" style=\"border:1px solid #DCDEE0;\">\r\n					<div class=\"para\">\r\n						Nano SIM卡\r\n					</div>\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td width=\"100\" align=\"left\" valign=\"center\" height=\"0\" style=\"border:1px solid #DCDEE0;\">\r\n					<div class=\"para\">\r\n						电池类型\r\n					</div>\r\n				</td>\r\n				<td width=\"590\" align=\"left\" valign=\"center\" height=\"0\" style=\"border:1px solid #DCDEE0;\">\r\n					<div class=\"para\">\r\n						不可拆卸式电池\r\n					</div>\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td width=\"100\" align=\"left\" valign=\"center\" height=\"0\" style=\"border:1px solid #DCDEE0;\">\r\n					<div class=\"para\">\r\n						重量\r\n					</div>\r\n				</td>\r\n				<td width=\"590\" align=\"left\" valign=\"center\" height=\"0\" style=\"border:1px solid #DCDEE0;\">\r\n					<div class=\"para\">\r\n						112 克\r\n					</div>\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td width=\"100\" align=\"left\" valign=\"center\" height=\"0\" style=\"border:1px solid #DCDEE0;\">\r\n					<div class=\"para\">\r\n						三围尺寸\r\n					</div>\r\n				</td>\r\n				<td width=\"590\" align=\"left\" valign=\"center\" height=\"0\" style=\"border:1px solid #DCDEE0;\">\r\n					<div class=\"para\">\r\n						123.8x58.6x7.6mm\r\n					</div>\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td width=\"100\" align=\"left\" valign=\"center\" height=\"0\" style=\"border:1px solid #DCDEE0;\">\r\n					<div class=\"para\">\r\n						支持频段\r\n					</div>\r\n				</td>\r\n				<td width=\"590\" align=\"left\" valign=\"center\" height=\"0\" style=\"border:1px solid #DCDEE0;\">\r\n					<div class=\"para\">\r\n						2G：GSM 850/900/1800/1900\r\n					</div>\r\n					<div class=\"para\">\r\n						3G：CDMA EVDO 800/1900/2100MHz\r\n					</div>\r\n				</td>\r\n			</tr>\r\n			<tr>\r\n				<td width=\"100\" align=\"left\" valign=\"center\" height=\"0\" style=\"border:1px solid #DCDEE0;\">\r\n					<div class=\"para\">\r\n						网络连接\r\n					</div>\r\n				</td>\r\n				<td width=\"590\" align=\"left\" valign=\"center\" height=\"0\" style=\"border:1px solid #DCDEE0;\">\r\n					<div class=\"para\">\r\n						Wi-Fi，IEEE 802.11 a/n/b/g\r\n					</div>\r\n				</td>\r\n			</tr>\r\n		</tbody>\r\n	</table>\r\n</p>','images/product/2.jpg','iphone,苹果手机,智能手机','1372253241','','');
INSERT INTO dou_product VALUES('3','1','魅族MX2智能手机','2399.00','','2012年11月27日，魅族科技在北京水立方召开新品发布会，正式发布了这款新作品。在外型设计方面，MX2将配备4.4寸1280×800显示屏，屏幕最窄边框仅3.15毫米，由夏普制造，魅族设计师为机身加入了手势功能，如滑动机身便可锁屏、在网页中放大缩小等，方便用户操作手机。魅族MX2采用的是专为魅族定制的MX5S处理器。<br />\r\n<br />\r\nMX2采用整体不锈钢龙骨及边框设计，完美无瑕的正面创新式的取消了实体按键，完全由一块墨玉般的玻璃构成，手机背壳采用了双料注塑成型的高难度设计和制造工艺带来了如钢似玉的梦幻产品外观。同时MX2采用了领先业界的4.4英寸16:10黄金比例，高达347ppi的超视网膜，代号为new mode 2新一代显示屏技术，1000:1对比度的精确色彩还原保证了顶级的通透靓丽显示效果，拥有58.6mm超宽显示宽度的同时，单玻璃全贴合、夜光的触控按键设计、内部全金属罩等工艺细节可谓无一处不用心。这一切，共同造就了魅族MX2这款科技纯简、工技至臻的艺术产品。<br />\r\n目前全球首款最窄边框为魅族MX系列，MX2它的边框只有3.15mm。也许，见到3.15mm边框宽度会有点失望，但其实与媒体之前曝光的资料相比，出入不大，因为魅族公布的这个数据是包括手机边框在内的，真正触摸屏的黑边估计就2mm左右。由于屏幕边框小，屏幕比例的不同等等，造成了这款屏幕比起其他4.4英寸手机的屏幕更宽，只是没那么高而已。<br />\r\nMX2采用了领先的独立芯片群配置，全球独家采用魅族新一代MX5S 1.6G Hz高速四核cpu（MX5S是由三星为魅族提供的CPU），较上一代四核处理器，效能提升20%以上，同时更加省电，533 MHzGPU,2 GB RAM，十层任意互联电路板、高端独立芯片群等超群的硬件配置本身又具备了极佳的系统协作和效能稳定性，让用户在使用顶级硬件配置的同时忘记参数，尽享畅快。<br />\r\n<br />\r\n<br />\r\nMX2拥有目前智能手机领域最先进的新一代800万像素背照式摄像头，全新一代的背照式传感器，并内置独立的Fujitsu ISP图像处理芯片引擎，同时镜头由5枚高品质光学镜片定制而成，配备4层镀膜的蓝玻璃滤光片，这一完美的结合大大增强了图像的降噪能力，有效提升画质。其次拥有F2.4的光圈和WDR宽动态技术，也能加强弱光的拍照效果，使得拍照效果更加唯美如真，在任何苛刻条件下都表现出色、值得信赖。而蓝玻璃滤光片的加入更是让摄像头的表现能力更加强大，它可以用来消除红外光以及修整进来的光线，比起普通玻璃滤片有更好的穿透性，使得其在配合特殊镀膜的情况下可以明显提升拍摄的画质表现，特别是在强光环境下的表现，可以校正过暖的偏色，在曝光以及噪点控制方面都做到了极致，从而更精确地过滤红外线等多余光线的干扰，确保色彩更加纯净自然。拥有1.5秒9张极速连拍功能、四方向全景模式、笑脸拍摄、手势拍摄、WDR、陀螺仪对焦、74°广角、蓝玻璃滤光片、图像编辑、色彩滤镜等多种功能，还具备在摄像模式下进行拍照的功能。魅族官方介绍这枚摄像头主要为画质而生的，强调用的是最好的BSI感光元件，同时还会有独立拍照图像处理芯片。总之魅族MX2的成像效果对于上一代MX有了质的飞跃，并且有接近超越iPhone5这样的移动端拍照利器之势，建立了高端智能手机中全功能相机的新标准。<br />\r\n<br />\r\n<br />\r\nMX2搭载了魅族全新开发的Flyme2.0， Flyme2.0是魅族基于Android4.1专门为魅族智能手机定制开发的，集操作系统、云服务、在线应用等为一体的系统服务，相对于之前广受好评的Flyme1.0有多达3452项的交互改进，并全新开发了应用加密、多媒体便笺、四方向全景拍摄等417项新功能。新系统交互和UI设计中凝聚着魅族创始人J.Wong所推崇的简约素雅的审美哲学，追求一种超越外在、挑战时间的设计宗旨，在用户体验上强调一种长久使用后的舒适感。MX2智能手机备有16GB、32GB 及64GB版本可供选择，更大的梦想空间让高清影音尽情发挥。<br />\r\nMX2是一部艺术创作与强大的人性化操作系统与云服务的集合体，同时魅族将凭借线下400家认证专卖店和京东商城等优质的渠道战略合作伙伴，一道为用户提供最佳的产品购买和客户服务体验。让我们一同期待梦想，享受MX2，分享这个本年度手机行业的最大惊喜。2013年1月份，魅族与联通携手发布魅族MX2联通合约机，为广大消费者提供了更多的购机模式。<br />\r\n魅族在智能手机研发领域不断追求创新、领先、超越，执着而专注，我们相信MX2四核智能手机必定为用户带来超乎想像的崭新体验。<br />','images/product/3.jpg','魅族,mx,安卓智能手机,国产神器','1372253551','','');
INSERT INTO dou_product VALUES('4','5','Amazon Kindle电子书阅读器','849.00','','Amazon Kindle由 Amazon生产的一系列电子书阅读器。第一代Kindle于2007年11月19日发布，用户可以通过无线网络使用 Amazon Kindle 购买、下载和阅读电子书、报纸、杂志、博客及其他电子媒体。由 Amazon旗下 Lab126 所开发的 Amazon Kindle 硬件平台，最早只有一种设备，现在已经发展为一个系列，大部分使用 E Ink 十六级灰度电子纸显示技术，能在最小化电源消耗的情况下提供类似纸张的阅读体验。电纸书Kindle Paperwhite和平板电脑Kindle Fire HD于2013年6月7日下午正式在国内市场开售，上市的档口，汉王科技宣布将推出新款电纸书产品，阻击之意不言而喻。<br />\r\n<br />\r\nAmazon是全球第一大网络书店，Kindle 竞争力除了丰富的资源外，主要特点还有它的网络支持功能，包含Wi-Fi和3G两种网络方式。其中3G网络为 Amazon 和 Sprint 合作的 CDMA EV-DO无线网络，不像 Wi-Fi 需要外界网点支持。Amazon 提供逾9万种电子书供用户下载，大多数的电子书售价为9.99美元，而且还可以订阅报纸杂志，诸如纽约时报、华尔街日报、华盛顿邮报和时代周刊、福布斯等，甚至还可以订阅 blog，但是需要付费的。<br />\r\n<br />\r\nKindle版本众多，主要包括电纸书和平板电脑两大类别。我们通常说的kindle电纸书，是使用e-ink技术的便携式电子书阅读器；kindle 平板主要是kindle fire系列，是7寸和8.9寸彩色平板电脑。此外，amazon还发布免费的kindle应用版，比如我们可以在电脑上或者IPAD iphone上用kindle应用来阅读。在美国，我们可以很方便地用kindle在线购买大量书籍，免费查维基百科，下载各种视频和影音资料。<br />\r\n<br />\r\nKindle电纸书和平板价格相对低廉，原因在于amazon公司以内容（如kindle ebook等）销售为主要收益来源。Amazon提倡以长远盈利为考量，而非靠硬件赢得收益，进行了不少产品和经营模式的创新。比如，amazon kindle基本上在每个机器型号都推出了special offer版本。这个版本的价格普遍比普通版本低15到20美元。这个special offer版本通过显示广告商的广告来降低机器成本。国内将带有special offer的版本称为“广告版”。如果考虑到special offer版本上的广告并不影响阅读体验，同时经常在这个版本推送优惠券，翻译为“特价优惠版”更为合适。<br />','images/product/4.jpg','kindle,amazon kindle,电子书阅读器','1372254423','','');
INSERT INTO dou_product VALUES('5','1','ThinkPad笔记本电脑','6800.00','','ThinkPad，中文名为“思考本”，在2005年以前是IBM PC事业部旗下的便携式计算机品牌，凭借坚固和可靠的特性在业界享有很高声誉。在联想（Lenovo）收购IBM PC事业部之后，ThinkPad商标为联想所有。ThinkPad自问世以来一直保持着黑色的经典外观并对技术有着自己独到的见解，如：TrackPoint（指点杆，俗称小红点）、ThinkLight键盘灯、全尺寸键盘和APS（Active Protection System，主动保护系统）。<br />\r\n<br />\r\nThinkPad的设计灵感来自传统的饭盒，ThinkPad最初的设计工作是由IBM位于日本的大和设计中心承担的。ThinkPad纯黑色外观的灵感来自日本传统的一种漆器饭盒：松花堂便当，它通体黑色且常用来装午饭。<br />\r\n&nbsp;&nbsp;<br />\r\nIBM在1992年开始发布ThinkPad产品，其中就包括ThinkPad 700[1]。最初的ThinkPad并没有键盘，理应属于平板电脑（tablet computer）的范畴。它装配有黑白液晶显示屏（LCD）、替代硬盘驱动器的40MB闪存（Flash Memory）、基于Go的PenPoint OS操作系统和IBM研发的笔迹识别系统。IBM随后又发布了预装Microsoft Windows 3.1且带有键盘的ThinkPad，售价US,350，重3千克（6.5l磅），尺寸是2.2×11.7×8.3英寸（56×297×210mm）。它还装配了当时最大的10.4英寸（264毫米）液晶显示屏，25MHz 386SX中央处理器，120MB硬盘驱动器还有一个手感良好的带有TrackPoint指点杆的键盘。明亮的红色TrackPoint被安装在键盘上，没有了鼠标的累赘人们能够在飞机客舱托架上使用方便地便携式电脑。<br />\r\n<br />\r\n尽管采用平版电脑设计的ThinkPad在商业上并不成功，但是它和Apple Newton共同开创了人类使用PDA（Personal Digital Assistant，个人数字助理）和移动计算的时代。[1]<br />\r\nThinkPad品牌即源于“思考”。ThinkPad之父内藤先生说过：“如果人们能够赋予一种产品以思考的力量，那么它必定拥有超越于技术之上的价值。”<br />\r\n<br />\r\n在过去的16年里，ThinkPad缔造了许多辉煌，也缔造了许多个业界第一。截至2008年年底，ThinkPad 在全球所获各种业内大奖已超过了3500项，这几乎是其他品牌所无法逾越的巅峰；而ThinkPad创造的无数经典力作也在移动发展史上构筑了一道道“里程碑”。<br />','images/product/5.jpg','ThinkPad,思考本','1372254741','','');
INSERT INTO dou_product VALUES('6','4','BlackBerry黑莓9780','1860.00','','<span style=\"color:#000000;\">黑莓手机（BlackBerry）是加拿大RIM通信公司的一家手提无线通信设备品牌，于1999年创立。其特色是支援推动式电子邮件、行动电话、文字短信、互联网传真、网页浏览及其他无线资讯服务。较新的型号亦加入个人数码助理功能如电话簿、行事历等及话音通讯功能。大部分BlackBerry设备附设小型但完整的QWERTY键盘，方便用户输入文字。</span><br />\r\n<br />\r\n<span style=\"color:#000000;\">在“911事件”中，美国通信设备几乎全线瘫痪，但美国副总统切尼的手机有黑莓功能，成功地进行了无线互联，能够随时随地接收关于灾难现场的实时信息。之后，在美国掀起了一阵黑莓热潮。美国国会因“911事件”休会期间，就配给每位议员一部“Blackberry”，让议员们用它来处理国事。</span><br />\r\n<span style=\"color:#000000;\">随后，这个便携式电子邮件[1]设备很快成为企业高管、咨询顾问和每个华尔街商人的常备电子产品。迄今为止，RIM公司已卖出超过1.15亿台黑莓，占据了近一半的无线商务电子邮件业务市场。</span><br />\r\n<span style=\"color:#000000;\">什么是黑莓从技术上来说，黑莓是一种采用双向寻呼模式的移动邮件系统，兼容现有的无线数据链路。</span><br />\r\n<br />\r\n<span style=\"color:#000000;\">黑莓手机名字由来它出现于1998年，RIM的品牌战略顾问认为，无线电子邮件接收器挤在一起的小小的标准英文黑色键盘，看起来像是黑莓表面的一粒粒种子，就起了这么一个有趣的名字。现在，黑莓独特的按键位置安排也是其一特色。</span><br />\r\n<br />\r\n<span style=\"color:#000000;\">黑莓手机的操作系统OS系统是Operation System的简称，其实就是操作系统的意思。黑莓的系统也有叫blackberry的，智能水平很高，是非常好用的智能机。</span><br />\r\n<br />\r\n<span style=\"color:#000000;\">黑莓智能手机的市场份额也不断地被竞争对手苹果iPhone和谷歌Android系统手机蚕食。数据显示，苹果2011年最后3个月出售了3700万部iPhone，超过黑莓过去3个季度的出货量总和。在截至3月3日的财季内，RIM的黑莓手机出货量仅为1110万部。</span><br />\r\n<br />\r\n<span style=\"color:#000000;\">另外，RIM尽管一直在努力进军消费市场，但是却受困于高昂的成本支出。RIM在智能手机领域无法争先，其去年推出的平[2]板电脑PlayBook销量也是停滞不前，RIM目前仍然无法成功进军平板电脑市场。同时，RIM股价让投资者心灰意冷。2011年，RIM股价下跌幅度超过75%，市值蒸发了300亿美元。而应用开发者依旧不愿为黑莓和PlayBook开发应用。</span><br />\r\n<br />\r\n<span style=\"color:#000000;\">2013年01月21日，日前，黑莓CEO海因斯在接受德国媒体Die Welt采访时透露，公司将在发布下一代手机操作系统BlackBerry 10后考虑出售旗下的硬件部门。海因斯指出，虽然公司没有必须仓促地做出这样的决定，但是为了能够让公司能够继续成功地运转下去，他们不得不考虑到所有的可能性。</span>','images/product/6.jpg','BlackBerry,黑莓手机','1372255876','','');
INSERT INTO dou_product VALUES('7','1','MacBook Air笔记本电脑','7650.00','','<p>\r\n	Apple 推出世界上最薄的笔记本，MacBook 家族（MacBook，MacBook Pro）的新成员，时尚纤薄的MacBook Air ，最薄处0.16英寸(约4mm)最厚处为0.76英寸（约19.4mm）的笔记本。\r\n</p>\r\n<p>\r\n	Macbook Air(20张)008年2月19日，苹果发布了当时全球最薄的笔记本电脑——MacBook Air [1]（以下简称MBA），这款13.3寸LED屏幕笔记本最薄处仅4mm（平均厚度）。简直就是SONY在4年前推出的X505的翻版（巧克力键盘，平均为1.5CM，数据来自：[2]）。MBA所营造的视觉上的美感是很难用语言来形容的，MBA之所以能做到如此之薄主要源自于LED屏幕和特殊处理器的采用，MBA所采用的处理器是英特尔专门为苹果定制的，这种定制的处理器也属于酷睿2系列，但是面积比标准的酷睿2处理器要小很多，功耗也要低不少，这种定制的酷睿2处理器的应用，不仅有益于MBA的轻薄，也为MBA的良好散热提供了很好的支持，使MBA成为了Mac系列电脑中发热量最小的电脑。首批发售的MBA配备的处理器型号是P7500，主频1.6GHz，具有4M二级缓存和800MHz前端总线，没有使用超低电压版处理器，估计苹果也是希望MBA在性能上也有可观的表现，并不想它沦为纯粹具有便携性的产品。\r\n</p>\r\n<p>\r\n	010年10月，苹果发布第二代MBA。这次升级使MBA有了两种机型：传统的13.3英寸和新增的11.6英寸。它们的最大特点是用闪存代替硬盘，64GB～256GB的闪存被直接嵌入主板，节省了巨大空间来存放电池，这使13.3英寸机型的使用时间提升到7小时。\r\n</p>\r\n<p>\r\n	2011年7月，苹果再次升级了MBA。全新的MBA搭载双核Intel Core i5和四核Core i7处理器，在性能上实现了飞跃。这次升级后苹果的入门级笔记本Macbook在官网中消失，Mac笔记本家族只剩下Macbook Air和Macbook Pro。这也意味着MBA，一款超便携型笔记本，已经具有一般笔记本的性能和经济性。\r\n</p>\r\n<p>\r\n	2012年6月12日凌晨，苹果发布新款MacBook Air笔记本电脑（第四代）。根据资料，新版的MacBook Air 采用Intel第三代Core i5双核处理器（22纳米，代号Ivy Bridge，主频为1.7GHz，共享3M的L3；主板集成低电压版的4GB 1600MHz DDR3L内存（可加钱升到8GB）；采用SSD固态硬盘（SSD已固化到主板上），容量为64GB / 128GB（可以加钱升到256GB 或512GB），据说速度能达到500MB/s，不知是不是采用SandForce主控；集成Intel HD Graphics 4000显卡，提供2个USB 3.0接口和1个雷电（Thunderbolt）接口，支持Bluetooth 4.0，能续航5个小时，整机重量只有1.08 千克，最厚处仅有1.7 厘米。新版MacBook Air将于年内在国内上市，苹果中国官网公布MacBook Air 11英寸RMB7388起售；MacBook Air 13英寸RMB8888起售。\r\n</p>\r\n<p>\r\n	据苹果官方介绍，11寸版的MacBook Air续航时间可达9个小时，较前一代提升了将近一倍；13寸版本的更可达12小时。\r\n</p>\r\n<p>\r\n	在效能方面，使用第四代Intel Core系列的MacBook Air，在图像处理效能上将有40%的增长，11寸版的与13寸版的将都有128GB和256GB SSD版本选择。\r\n</p>\r\n<p>\r\n	在说到价格问题，11英寸新款Macbook Air的国行价格为7388元（128GB闪存）、8888元（256GB闪存）；13英寸价格为8888元（128GB闪存）、9688元（256GB闪存）。\r\n</p>\r\n<p>\r\n	自苹果MacBook系列笔记本电脑于2005年面世以来，就成为苹果的“吸金”利器，在全球各个角落为苹果公司赚取了全年超过47.9%的净利润。新推出的MacBook Air外形上采用了最新的“楔形”设计，最厚处1.8厘米，最薄处为0.3厘米，由宽至窄的设计简单时尚。而且MacBookAir将主板的位置放在了较厚的电脑后半侧，即使用手托着使用，手臂也能一直保持冰凉清爽。除此以外，对于要求电脑能够长时间待机的要求，MacBook Air也成了不二之选，7小时的续航能力，30天待机，只需用手轻轻一碰，可以随时被唤醒。\r\n</p>\r\n<p>\r\n	配备新一代 Intel 处理器、图形处理器与更快的闪存，这款日用笔记本电脑， 表现更显不凡。\r\n</p>','images/product/7.jpg','MacBook Air,超薄笔记本电脑','1372256828','','');
INSERT INTO dou_product VALUES('8','2','创意沙发','2800.00','','<p>\r\n	英语Sofa的译音。装有弹簧或厚泡沫塑料等的靠背椅，两边有扶手。老舍《且说屋里》：“包善卿也似乎无可顾虑了，躺在沙发上闭了眼。”郭小川《一个和八千》诗：“其舒适的程度也不亚于坐沙发。”《花城》1981年第5期：“一张两用沙发，早上没有整理，铺着粉红色线绨被面的薄被。”　Sofa的音译，一种有弹簧衬垫的靠背椅，现多用弓状弯曲的弹簧与泡沫塑料，制作简便，可使体形轻巧，现代家中常有家具之一。“沙发”是个外来词，根据英语单词sofa音译而来，也就是我们坐的工具，以前叫凳子，高级啦~用外裹真皮及合成皮，构架是用木材或钢材内衬棉絮及其他泡沫材料等做成的椅子，整体比较舒适。\r\n</p>\r\n<p>\r\n	沙发的起源可追溯到公元前2000年左右的古埃及，但真正意义的软包沙发则出现于十六世纪末至十七世纪初。当时的沙发主要用马鬃、禽羽、植物绒毛等天然的弹性材料作为填充物，外面用天鹅绒、刺绣品等织物蒙面，以形成一种柔软的人体接触表面。如当时欧洲普遍流行的供大众使用的华星格尔（Farthingle）椅，是最早的沙发椅之一。回顾中国的沙发发展史，要首推汉代的“玉几”。 《西京杂记》中描绘的缚有厚层织物的坐具“玉几”，可以看作是中国沙发的“祖先”。\r\n</p>\r\n<p>\r\n	发已是许多家庭必需的家具。市场上销售的沙发一般有低背沙发、高背沙发和介于前两者之间的普通沙发三种。下面分别介绍三种的特点，供消费者选择购买。\r\n</p>\r\n<p>\r\n	低背沙发：属于休息型的轻便椅。它以一个支撑点来承托使用者的腰部（腰椎）这种沙发靠背高度较低，一般距离座面370毫米左右，靠背的角度也较小，不仅有利于休息，而且使整个沙发外围尺寸相应缩小。这种沙发搬动比较方便、轻巧，占地面积小。\r\n</p>\r\n<p>\r\n	高背沙发：又称航空式座椅。它的特点是有三个支点，使人的腰、肩部、后脑同时靠在曲面靠背上。这三个支撑点在空间上不构成一条直线，因而制作这种沙发技术要求较高，购买时挑选难度也比较大。制做高背沙发的木架，必须在架子上明确地做好三点所构成的转折面，否则进行沙发蒙面等工序时就难于确保支撑点的位置，给使用者带来不舒适感。选购高背沙发时要注意其背面的三个支撑点的构成是否合理、妥当，可通过试座加以判定。高背沙发是从躺椅演变而成的。为提高休息性能，还可配做脚凳，放置沙发前，其高度可与沙发座面的前沿高相同。\r\n</p>\r\n<p>\r\n	普通沙发：是家庭用沙发中常见的一种。市场上销售的多为这类沙发。它有两个支撑点承托使用者的腰椎、胸椎，能获得与身体背部相配合曲面的效果。此类沙发靠背与座面的夹角很关键，角度过大或过小都将造成使用者的腹部肌肉坚强，产生疲劳。同样，沙发座面的宽度也不宜过大，通常按标准要求在540毫米之内，这样使用者的小腿可随意调整坐姿，休息得更舒适。\r\n</p>','images/product/8.jpg','创意沙发','1372257655','','');
INSERT INTO dou_product VALUES('9','2','衣物收纳箱','56.00','','<p>\r\n	其实收纳工作并不麻烦，不管户型有多大，总会有更多的储物空间等待你去发现。小空间里的家居收纳尤为重要，面对井然有序的家，想必你的心情也会随之雀跃起来。\r\n</p>\r\n<p>\r\n	拥有较大户型的厨房固然是件好事，但杂碎的厨房用品同样需要合理归置。让我们跟上收纳达人安妮的脚步，剖析厨房里的秘密武器，学习如何布局实现简约风尚。\r\n</p>\r\n<p>\r\n	如果你也同安妮一样需要长时间保持坐姿状态，或是与你的宠物狗进行交流与互动，或是和你的好友海阔天空的闲谈，一款舒适的座椅则必不可少。亲切的色调可以拉近彼此的距离，而一盆新鲜的绿植亦能点亮各自的情绪，令双方都保有愉悦的心境。\r\n</p>\r\n<p>\r\n	这面精简的壁柜提供了毫不起眼的储藏空间，干练的线条搭配柔和的色调成为就餐区优雅的背景。不规则晕染开的色泽在原木色的基调中显露出不经意的变化之美。\r\n</p>\r\n<p>\r\n	造型令人惊叹的吊灯给餐厅带来魅力的同时也提供了更多的话题。抽象的演绎，充满现代的酷感，将会带给你更多厨房照明的灵感。\r\n</p>\r\n<p>\r\n	打开壁柜的拉门，你会发现安妮已根据不同物品的收纳需求，在内部为她们度身定制了巧妙的隔架内饰，以最大限度来存放这些与好友分享的红酒和盛器。\r\n</p>\r\n<p>\r\n	抽屉、壁橱、吊柜，这些再普通不过的设计元素，几乎是每个小户型厨房总会运用的一至两个收纳方式，而贴合墙面的U字型陈列更是节省空间的最佳方案。若你认为它仅此而已，那你就大错特错了。待我们展开柜门，带你领略其中的大不同。\r\n</p>\r\n<p>\r\n	灰色的不锈钢台面耐用且便于清洁。为一侧的吧台配置几把氛围轻松的椅子，让料理台的作用不再仅限于烹饪，从此让功能介于厨房和学习园地之间。\r\n</p>\r\n<p>\r\n	开放式的厨房需要一个功效强劲的油烟机，这款带有排气罩的壁挂式感应油烟机便是整个厨房的焦点。<br />\r\n直排抽取式的设计造就了一个身材苗条的调味品收纳架。你不觉得这样的创新富有生活的感悟吗?若是以前，即使将瓶瓶罐罐整齐地排放成四方形，也可能因为光线的死角而看不清楚最里面放的到底是酱油，还是陈醋呢。瓶身上的标签赤裸裸的展现你眼前，无需费时即可信手取得。\r\n</p>\r\n<p>\r\n	或许有人会说，我可以把这些调味品都摆放在料理台之上，那你有没有想过长时间暴露在油烟下会导致瓶身粘糊糊的呢?我想安妮的方法是目前最为理想的。对于体型稍高的瓶子，我们将拉门的内部进行微调，选用双层木条或提升挡板的高度来防止玻璃瓶在移动中跌落。而木条间的缝隙正好露出调味品的名称。<br />\r\n高性能的家电有时也能帮助你节省一定的收纳空间。当派对还未开始，当桌子上已满是各类食物，当刚烤好的甜点没有容身之处，这时具有保温功能的烤箱便能代为保管，不用再为没有空地而烦恼。四层的大型烤箱镶嵌于壁柜之间，也绝不会占用你多余的地盘。\r\n</p>\r\n<p>\r\n	存放餐具的抽屉里被三角形的小木条进行了合理分割，从而固定各类用品的位置。在抽取时就不会因为作用力的关系导致餐具之间的碰撞和磨损。\r\n</p>','images/product/9.jpg','衣物收纳箱','1372257993','','');
INSERT INTO dou_product VALUES('10','2','实木餐桌','680.00','','<p>\r\n	餐桌的原意，是指专供吃饭用的桌子。按材质可分为实木餐桌、钢木餐桌、大理石餐桌、大理石餐台、大理石茶几、玉石餐桌、玉石餐台、玉石茶几、云石餐桌等。\r\n</p>\r\n<p>\r\n	一些非常早期的表和埃及人所用，多一点的石头平台，用于保持物体离地面。座位的人，他 们都没有使用。食品和饮料通常被放在一个基座上吃。埃及人使用各种小桌子和高架打板。中国也很早就有桌子，为了追求艺术的写作和绘画。\r\n</p>\r\n<p>\r\n	希腊人和罗马人更频繁使用的表，尤其是吃，虽然希腊表压床底下使用后。希腊人发明了一种非常相似的盖里东一件家具。表大理石或木材和金属（通常是铜或银 合金）制成的，有时有丰富华丽的腿。后来，大方桌独立的平台和支柱。罗马人也推出了大量的，半圆形表意大利，叶斑。\r\n</p>','images/product/10.jpg','实木餐桌','1372258272','','');
INSERT INTO dou_product VALUES('11','2','客厅吸顶灯','180.00','','一种灯具，安装在房间内部，由于灯具上部较平，紧靠屋顶安装，像是吸附在屋顶上，所以称为吸顶灯。光源有普通白灯泡，荧光灯、高强度气体放电灯、卤钨灯等。<br />\r\n<br />\r\n吸顶灯市场的发展分为三个阶段：一是“市场销量大，生产跟不上”；二是“牌子已不少，各有各的份”；三是“竞争更激烈，大家抢蛋糕”。<br />\r\n<br />\r\n尽管吸顶灯市场看似红红火火，市场容量丝毫未减，但吸顶灯市场带有一些“泡沫色彩”，众多中小型企业无开发、无营销，却不断地扰乱正常的经济秩序；还有部分中型企业抛开产品要素，专攻营销，这样容易闯入一个误区--因为产品才是营销的基础。从国家质检部门近两年来对吸顶灯质量的抽查结果也可以看出，吸顶灯企业太注重价格，而忽视了产品本身，吸顶灯质量令人堪忧，给消费者的人身与财产安全带来巨大的隐患。<br />\r\n<br />\r\n大部分吸顶灯企业缺少两种主要元素：技术人才和产品生产设备。企业应该重新审视自身的优势与缺陷，只有先牢固企业基础，稳扎稳打，才不会被市场激烈竞争的形势所淘汰。<br />','images/product/11.jpg','客厅吸顶灯,LED吸顶灯','1372258494','','');
INSERT INTO dou_product VALUES('12','3','Pampers帮宝适超薄干爽纸尿裤','118.00','','帮宝适，美国宝洁公司著名婴儿卫生系列产品。是一种吸水性能良好、佩戴舒适的一次性纸尿裤诞生了。宝洁公司将它命名为“帮宝适”，并于1961年正式推向市场，迎接它的是无数欣喜若狂的妈妈和她们的宝宝。 在以后的三十八年中，“帮宝适”经由宝洁公司的多次改进，成为行销全球一百多个国家的世界第一婴儿纸尿裤品牌。1997年自帮宝适在中国面世以来，在目标消费者中的知名度已达到99%，成为市场上首屈一指的领导品牌。','images/product/12.jpg','帮宝适,纸尿裤','1372259573','','');
INSERT INTO dou_product VALUES('13','3','法国合生元奶粉','128.00','','合生元，用心专注母婴营养与健康。携手法国Lallemand集团、法国Montaigu乳品公司、法国Diana Naturals公司和美国Kerry公司等全球战略合作伙伴，共同研发高科技含量的优质产品。合生元将秉承“把优越做成产品，把责任变成品质”的理念，全面提供益生菌冲剂、婴幼儿奶粉、妈妈奶粉、多种营养食品等母婴营养健康产品，给宝宝聪明IQ、爱心EQ、活力PQ发展的均衡营养。为准妈妈和宝宝提供专业、健康、安全的产品和服务，这是合生元的坚持和追求。合生元，与全中国的妈咪一起，培养聪明的、活泼的、有爱心的Q宝宝。<br />\r\n<br />\r\n为进一步巩固我们与消费者的关系，让他们分享各自的经验，收集到有用的建议，我们建立了妈妈100品牌，以会员平台和网站的形式，让我们的会员通过访问网站，拨打客服热线电话，得到服务和育儿咨讯。我们以此进行会员积分系统管理。<br />\r\n广州<br />\r\n<br />\r\n广州市合生元生物制品公司(2张)市合生元生物制品有限公司成立于1999年。2006年，我们在广州经济技术开发区建立了益生菌GMP工厂，拥有自己的研发团队、产品质量检控设备，这是中国洁净度级别最高的益生菌工厂之一。2010年12月17日，合生元（HK.1112）于香港联合交易所主板成功上市。我们的公司在全国拥有12个大区及77个销售办事处，超过2000名员工。<br />','images/product/13.jpg','合生元,奶粉','1372259850','','');
INSERT INTO dou_product VALUES('14','3','PES宽口套装奶瓶','280.00','','一直以来，布朗博士的品牌焦点都是为促进婴儿的身体健康和最佳营养创造最好的喂哺产品。<br />\r\n<br />\r\n1996年，由美国医学博士Craig Brown（科蕾吉·布朗）设计出第一个功能性奶瓶，1997年获得国际专利。Dr.Brown\'s Natural Flow®/布朗博士好流畅® 奶瓶是第一个具有导气系统的奶瓶，它仿效母乳喂养的原理，彻底解决传统奶瓶所不能克服的“真空、气泡、负压”等喂养中存在的问题。2000年荣获美国医学设计金奖，这种独特的设计给妈妈唯一取代传统奶瓶的选择，从布朗博士开始这种“正压、自然流畅”的喂养方式，实际上与母乳喂养的体验相似。直到今天，我们仍然是唯一一个以这种方式工作的奶瓶。<br />\r\n&nbsp;&nbsp;<br />\r\n自推出后，布朗博士奶瓶得到了医学界的许多设计奖项和赞誉。事实上，我们的奶瓶被很多医院、新生儿重症监护室和医生办公室推荐使用。最重要的是来自世界各地的妈妈和爸爸的褒奖，他们高兴地分享他们改善婴儿喂养习惯的经验。这份关注和支持是我们发展的最大动力。<br />\r\n<br />\r\n与我们的奶瓶标准一致，每一个布朗博士的产品都提供了功能应用上的独特设计，以促进和维护婴儿更好的健康需要。为了维护这个妈妈可以信赖的品牌，我们在产品研发和生产付出了很大的投入，以确保每一个产品达到最好的使用效果，这意味着：我们投入必要的时间，尽可能创造高品质的、独特的、有益健康的婴儿喂哺产品。<br />\r\n<br />\r\n布朗博士奶瓶不仅是美国最畅销奶瓶品牌，目前在欧洲、亚洲、非洲等世界各个地区都有授权分销，广州市科蕾吉贸易有限公司是布朗博士唯一授权中国地区销售总代理。到目前为止，我们已在中国地区设立了30多个省级代理，有上千个零售网点。<br />','images/product/14.jpg','PES宽口套装奶瓶','1372260271','','');
INSERT INTO dou_product VALUES('15','3','亨氏Heinz金装粒粒面鳕鱼胡萝卜面','68.00','','亨氏公司是在1869年由H J Heinz在美国宾夕法尼亚州夏普斯堡创立的，经过一百多年卓有成效的发展，由当时的小农场成为世界最大的营养食品生产商之一。亨氏的产品有5700多种，除了人们熟知的婴儿米粉外，还有番茄酱、调味品、沙司和冷冻食品等。该公司的分支机构遍及全球200多个国家和地区。2012年2月，股神巴菲特及巴西资本投资公司3G看中亨氏集团的优异业绩表现，以总价280亿美元收购亨氏集团，创下同类企业的收购最高纪录。<br />\r\n<br />\r\n亨氏调味品在全球140个国家年销售额高达25亿美元，仅亨氏番茄酱在全球的年销售量就达到6亿5千万瓶。亨氏每年生产的小袋装番茄酱或其它调味酱多达110亿包，相当于全球人手两包。“亨氏就是番茄酱”更为全世界的人们津津乐道。 亨氏的冷冻食品以其无可比拟的美妙滋味和方便快捷在全球拥有20亿的销售额。<br />\r\n<br />\r\n全球的父母都信赖亨氏。2002年，全球的父母为自己的宝宝购买亨氏婴幼儿食品、饼干、谷物食品以及果汁，累计花费近10亿美元。亨氏的营养专家紧跟科技前进的步伐，不断推陈出新，为各国宝宝提供更多的营养美味，倍可信赖的“亨氏”亦让越来越多的中国父母青睐有加。<br />\r\n<br />\r\n在许多国家，亨氏意味着浓汤、焗豆和意大利面食。在这个充满活力的品类中，亨氏同样业绩斐然。创新性的产品以及突破性的广告让亨氏在英国乃至欧洲的汤类市场独占熬头。 亨氏的创始人H·J·亨氏有一句名言：“将平凡的事情做得非凡地出色，此乃亨氏成功之道。”亨氏集团现任首席执行官孙博廉先生（William R. Johnson）表示：“质量和创新是推动亨氏前进的原动力”。正是在这种指导思想的引领下，这个拥有 140多年悠久历史的食品王国正焕发出前所未有的勃勃生机。亨氏将一如既往，将最新的创意、最丰富的营养、最美妙的滋味一并奉献给全世界的每家每户，让人们更享美好精彩生活。<br />','images/product/15.jpg','亨氏,Heinz金装粒粒面鳕鱼胡萝卜面','1372260483','','');

DROP TABLE IF EXISTS dou_product_category;
CREATE TABLE `dou_product_category` (
  `cat_id` smallint(5) NOT NULL auto_increment,
  `unique_id` varchar(30) NOT NULL default '',
  `cat_name` varchar(255) NOT NULL default '',
  `keywords` varchar(255) NOT NULL default '',
  `description` varchar(255) NOT NULL default '',
  `parent_id` smallint(5) NOT NULL default '0',
  `sort` tinyint(1) unsigned NOT NULL default '50',
  PRIMARY KEY  (`cat_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO dou_product_category VALUES('1','digital','电子数码','ipad,iphone,三星','电子产品销售','0','10');
INSERT INTO dou_product_category VALUES('2','home','家居百货','家居用品,沙发桌椅,生活周边','家居百货产品销售','0','20');
INSERT INTO dou_product_category VALUES('3','baby','母婴用品','奶粉,营养辅食,尿裤湿巾,喂养用品,洗护用','母婴用品销售','0','30');
INSERT INTO dou_product_category VALUES('4','phone','智能手机','iphone,blackberry','智能手机销售','1','50');
INSERT INTO dou_product_category VALUES('5','tabletpc','平板电脑','ipad','平板电脑销售','1','50');

DROP TABLE IF EXISTS dou_show;
CREATE TABLE `dou_show` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `show_name` varchar(60) NOT NULL default '',
  `show_link` varchar(255) NOT NULL default '',
  `show_img` varchar(255) NOT NULL,
  `type` varchar(10) NOT NULL,
  `sort` tinyint(1) unsigned NOT NULL default '50',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

INSERT INTO dou_show VALUES('1','广告图片01','http://www.douco.com','data/slide/20130514acunau.jpg','pc','1');
INSERT INTO dou_show VALUES('2','广告图片02','http://www.douco.com','data/slide/20130514rjzqdt.jpg','pc','2');
INSERT INTO dou_show VALUES('3','广告图片03','http://www.douco.com','data/slide/20130514xxsctt.jpg','pc','3');
INSERT INTO dou_show VALUES('4','广告图片04','http://www.douco.com','data/slide/20130523hiqafl.jpg','pc','4');
INSERT INTO dou_show VALUES('5','手机版广告图片01','http://m.douco.com','data/slide/m/20140921rqmzcp.jpg','mobile','10');
INSERT INTO dou_show VALUES('6','手机版广告图片02','http://m.douco.com','data/slide/m/20140921kwoypm.jpg','mobile','20');
INSERT INTO dou_show VALUES('7','手机版广告图片03','http://m.douco.com','data/slide/m/20140921ypmnew.jpg','mobile','30');
INSERT INTO dou_show VALUES('8','手机版广告图片04','http://m.douco.com','data/slide/m/20140921demloy.jpg','mobile','40');

