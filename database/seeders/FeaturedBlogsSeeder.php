<?php

namespace Database\Seeders;

use App\Facades\Story;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Database\Seeder;

class FeaturedBlogsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $raffy = User::where('username', 'raffy')->first();
        $michael = User::where('username', 'michael')->first();

        // Story 1.
        $raffy_content = 'Ever since the covid-19 left many in shock at how quickly it had spread around the globe and in our very own country, every facets of our life were changed for better or worse. One such major change is our education system\'s shift into distance learning. Although a noble idea, Philippines is still a third world country, which makes it hard to have everyone be on board. Many private schools were forced to shut down due to classes being halted and the lack of new enrollees. The quarantine forced many students to stop studying due to varying reasons such as: lack of financial stability, lack of faith in our government to effectively implement this new type of learning, others were simply uncomfortable with this new method of studying and many more.\r\n\r\nIt has been a year already since classes started again. Limited face to face classes were once brought up but it did not pushed through due to a sudden surge in covid-19 infections. And so, a lot of places were put again under Modified Enhanced Community Quarantine (MECQ) to prevent another surge and to observe these locations which shows a high level of infection. Back to the new education system, this type of learning heavily relies on the use of modern technology. Students are encouraged to use their mobile phone and/or other gadgets with access to the internet to attend online classes. At first look, this looks like it will be convenient for both the teachers and the students but there are people who could not disagree more.\r\n\r\nThere is this long-time problem that existed since before the pandemic and that is our amazingly low internet speeds. The implementation of online classes made Filipinos effectively remember this problem. That is why, it is not surprising that some online discussion turns out to be non-productive due to the students or even teachers who are using these low speed internet connection who keeps lagging out. Students are also reported to receive way more home works than before the pandemic. This whole situation makes the new normal education system "sort of pointless" as others put it" as not everyone have the opportunity to study especially those with no access to gadgets or living in the province. Even those with opportunity but lives in a place with low signal or does not have the money to load an internat data is almost indistinguishable from those who have stopped studying.\r\n\r\nThere are also instances of some students having to work full time at night and study during the day due to the heavy blow that covid-19 and the following quarantine gave to each families\' financial capabilities. Hopefully, the teachers can be more considerate towards these type of students as they never wished to have to juggle both in the first place. They were forced into it. On a side note, some local governments provided tablets so that more students will be able to continue studying. A noble idea indeed, but one disadvantage of online classes is that the teachers can no longer monitor that activities of a student during the learning phase. No wonder, many students who have received tablets are using it for mobile games and other various mobile applications. There are even instances that while a teacher explains a certain topic while; the students are just connected to chat group, only there for attendance, pretending to listen and only responds when called by name although teachers may be aware of it. There was even a viral video where a teacher caught a student with his microphone on playing a mobile game called Call of Duty where the teacher said it\'s fine to not listen but not to be a nuisance with others willing to listen.\r\n\r\nWith all that said, the new normal education system is not all negative. First of all, it allows you to study in the comforts of your home. Some teachers also record their online discussions so even if you sleep late, arrived late or does not want to attend. You can just access or downlown these video recording any time you want. There is also the benefit of not having to walk or pay transportation fees whenever you go to school. You may even attend the online classes with your home clothes (or buck naked if you will) as students are no longer required to wear school uniforms. Introverts rejoice, as there is no longer any fear of having to interact with your classmates, answer your teachers question face to face or to have to present something in front of the class. Well, the teacher may still ask you to present something and turn on the camera prior but that\'s better than being present physically isn\'t it?\r\n\r\nEither way, no one really knows what will come out after the first of students of this new system after graduation. Will they have difficulty finding a job? Will they be forced to spend a few years doing work they do not like? Will the number of students that was originally on board with online classes stay the same after graduating? That and more questions that are yet to be formulated. What do you think? Please write in the comments sections and give your reactions. Thank you for reading this article! Hoping that this did not only provided information but also entertained you as our valued readers. Stay tuned for another article!';
        $raffy_blog = Blog::create([
            'author_id' => $raffy->id,
            'title' => 'Classroom Situation Under the New Normal',
            'is_featured' => true,
            'content' => $raffy_content,
        ]);
        Story::compute_read_time($raffy_content, $raffy_blog);
        Story::sync_tags('Computer Science,New Normal,Classroom,Students', $raffy_blog);

        // Story 2.
        $michael_content = 'March 17 2020, the start of the enhance community quarantine here in NCR in which almost everything from different businesses, private and public operations including education had been ceased due to the pandemic, all kinds of service and transaction had been out of service which however, DepEd secretary Leonor Briones state that even though there is a pandemic happening education shouldn’t be stopped and declared that the schools shall resume at in October 5th which leads to many educational related problems in both schools and students side which leads to our what we so called new normal education, most people questioned this decision due to the well-known reason that most of students doesn’t really have a decent access on internet which is crucial for having and online class, multiple students as well as other poor country-men and women denied and against its decision over having an academic freeze, from lowering the number of work force as well as having filling up online sheets, synchronous and asynchronous classes also had been started, most people think that universities and school are just working for money some think that it is a biased decision against poor and unprivileged people, others had even think that the poor decision in education is a result of having incompetent government. Whatever the reason is, the new chapter of the education begins and whether we like it or not in order to keep pushing forward we must face our new set up and create more chances despite of having a upcoming challenging school year.';
        $michael_blog = Blog::create([
            'author_id' => $michael->id,
            'title' => 'EDUCATION OVER VIRUS, PENNY OVER PUPIL???',
            'is_featured' => true,
            'content' => $michael_content,
        ]);
        Story::compute_read_time($michael_content, $michael_blog);
        Story::sync_tags('Education,Students,New Normal', $michael_blog);

        // Story 3.
        $michael_content_another = 'Online class may be boring for some other students specially most professors and teacher were just sending files for lectures and activity which actually part of our new normal in education, students opinion about this issue was split into many point of views, such as "teachers are just sending files and nothing more its basically a self study with extra steps", others says that "we do have some professors and teacher who actually both sending files as aid as well as teaching which is great it really helps us to learn more, others think that "how disappointing to have teacher who is a slacker" and many more point of view, however having multiple perspective can lead into such disrespectful behavior against faculty members, recent an incident about how students acts in a synchronous meeting became a trending topic to discuss about some of students are actually not focus into these kind of set up and unfortunately some professor had been utterly disrespected by it. the footage about this had been spread like a wildfire on the internet creating multiple memes and puns through social media which leads to some people ask if our new normal in education really works or not. majority maybe believe it works the same as what education before was however the counts of those of actually disagree and disbelief is quite high still cant be ignored.';
        $michael_blog_another = Blog::create([
            'author_id' => $michael->id,
            'title' => 'Enough of this "kabastusan"',
            'is_featured' => true,
            'content' => $michael_content_another,
        ]);
        Story::compute_read_time($michael_content_another, $michael_blog_another);
        Story::sync_tags('Education,Students,New Normal', $michael_blog_another);
    }
}
