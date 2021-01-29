<!DOCTYPE html>
<html>
  <head>
    <title>Henry Harris - Blog</title>
    <link rel="stylesheet" href="/assets/bootstrap.min.css" />
    <link
      href="https://fonts.googleapis.com/css?family=Source+Code+Pro&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="/assets/style.css" />

    <script src="/assets/js/jquery-3.4.1.min.js"></script>
    <script src="/assets/js/handlebars.runtime-v4.7.6.js"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script
      async
      src="https://www.googletagmanager.com/gtag/js?id=UA-149253046-1"
    ></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag() {
        dataLayer.push(arguments);
      }
      gtag('js', new Date());

      gtag('config', 'UA-149253046-1');
    </script>
    <script src="/assets/js/templatesCompiled.js"></script>
    <script>
      const sidebar = Handlebars.templates['sidebar/sidebar']({});
      const sidebarFooterMobile = Handlebars.templates['footer/mobile']({});

      $(document).ready(function() {
        $('#sidebar').html(sidebar);
        $('#sidebar-footer--mobile').html(sidebarFooterMobile);
      });
    </script>
  </head>
  <body>
    <div id="sidebar" class="sidebar"></div>

    <div class="body">
      <div class="blog-header">
        <h3 class="blog-header__title">
          Using JSONB in Rails Forms
          <span class="blog-list__tag blog-list__tag--tech"></span>
        </h3>
        <p class="blog-header__date">December 11th, 2019</p>
      </div>
      <div class="blog-content">
        <div class="section">
          <h4>What is JSONB?</h4>
          <p>
            JSONB is PostgreSQL’s data type that stores JSON in decomposed
            binary form. There are many instances where you might want to use a
            JSON data type in an application. Maybe you want to tinker around
            with the data type in a side project. Maybe you want to store plain
            JSON. Maybe you want to use it while prototyping, saving the
            headache of database changes. Whatever your reason, this blog post
            is aimed at getting you up to speed in utilizing this data type in
            Ruby on Rails, specifically with forms.
          </p>
        </div>
        <div class="section">
          <h4>What does a model look like with a JSONB attribute?</h4>
          <p>
            For the examples that follow, I am going to use a classic Rails
            example, a blog app. In our blog app, we have a model, <span class="code">Post</span>, that
            has a <span class="code">title :string</span>, and some <span class="code">content :jsonb</span>. If you are
            starting from scratch, you can create this model using Rails’
            <span class="code">generate</span> command.
          </p>
          <script src="https://gist.github.com/dummycode/300f9fd2cd5c8320fc9816bfedd20136.js"></script>

          <p>
            After we have generated our model, we want to begin working with
            this JSONB attribute. If you just want to store plain JSON, you can
            immediately access this field by doing <span class="code">post.content</span>. This will
            return a JSON string that you can treat like any other JSON string
            in Ruby.
          </p>
          <p>
            Well that was easy, but a simple JSON string won't suffice for most
            production applications. Instead, let's investigate a way to more
            easily access and update attributes inside the JSONB field without
            having to pass around the entire JSON string. In order to easily
            access different fields in your jsonb data, you can use the
            <a href="https://github.com/madeintandem/jsonb_accessor"
              >jsonb_accessor</a
            >
            gem This gem allows you to set typed jsonb backed fields on your
            ActiveRecord models. To install, add <span class="code">gem 'jsonb_accessor'</span> to your
            <span class="code">Gemfile</span> and run <span class="code">bundle install</span>.
          </p>
          <p>
            Once installed, you can add accessors to your model. If you wanted
            to have string, <span class="code">body,</span> and an array of strings, <span class="code">sources</span>, as
            attributes, you would just need to add the following accessors to
            your model.
          </p>
          <script src="https://gist.github.com/dummycode/f039d953ecc89fca7446660e42672fc7.js"></script>
          <p>
            This adds <span class="code">body</span> and <span class="code">sources</span> as attributes on the model that are
            backed by their respective properties in the JSONB field. You see
            this working by going to the Rails console via <span class="code">rails c</span>, and
            running <span class="code">post = Post.new</span>, <span class="code">post.body</span>, and <span class="code">post.sources</span>.
          </p>
          <script src="https://gist.github.com/dummycode/475a8ef07d16d792dd6765872052004c.js"></script>
          <p>
            As you can see, when creating a new model, any accessor with a
            default is assigned that default value, otherwise the field is not
            set and thus is nil when accessed.
          </p>
        </div>
        <div class="section">
          <h4>Okay, now how do we hook this up to forms?</h4>
          <p>
            Luckily for us, standard fields work exactly like you’d expect them
            to. Since <span class="code">body</span> is a just a string attribute on the model, inside a
            <span class="code">form_for</span> you can add the following.

            <script src="https://gist.github.com/dummycode/6f7ac8fa0b693e7b2626fdbe32feed44.js"></script>
          </p>

          <p>
            Now, things get a little bit trickier when you want to add <span class="code">sources</span>
            to a form, since <span class="code">sources</span> is an array of strings. In order to pass
            the sources to the controller and then onto the model, we want to
            have the form submit data in the following structure.
          </p>
          <script src="https://gist.github.com/dummycode/3f294b43fd0b04a5fb3e4dcfbe60cdc6.js"></script>

          <p>
            To send over a data structure like this, we must have multiple
            fields on the form with names <span class="code">post[sources][]</span>. We can use
            JavaScript to dynamically add or remove these fields from the form,
            so the user may add or remove sources as they please.
          </p>
          <p>
            The first step in doing this is to create a re-usable source fields
            partial.
          </p>
          <script src="https://gist.github.com/dummycode/5b9328bc7b7d9dbdd8bc442a6f8e81c3.js"></script>
          <p>
            Note that <span class="code">source</span> is a local string variable passed to the partial.
            Also note the remove link! We are later going to hook up some
            JavaScript to remove the field when clicked.
          </p>
          <p>
            For the form itself, we should loop through all the sources on the
            model and render the field partial for them.
          </p>
          <script src="https://gist.github.com/dummycode/acbb6c5bc168f76c59dafdc55822ca05.js"></script>
          <p>
            <span class="code">add_source_button</span> is a helper function that renders an "Add
            Source" button. This could be done inline, but abstracting it out to
            a helper function is a good way to make this reusable in different
            views.
          </p>
          <p>
            The add source button helper looks like this.
          </p>
          <script src="https://gist.github.com/dummycode/f2d52a389bb1f4584d14b9fcf7928163.js"></script>
          <p>
            To dynamically render a new field when it is clicked, we pass
            rendered HTML in the data of the button. I will get into this in
            more detail in the JavaScript section.
          </p>

          <p>
            As far as JavaScript goes, we need a way to dynamically add and
            remove these fields when certain buttons are clicked. I used jQuery
            for this as I found it easiest, but any JS library or even vanilla
            JS should be able to accomplish this.
          </p>
          <p>
            Whenever a <span class="code">add-fields</span> class button is clicked, we want to add a
            field so the user can enter a new source.
          </p>
          <script src="https://gist.github.com/dummycode/1e0d67bf7c369466d4fa24c1e852f25f.js"></script>
          <p>
            This jQuery listener uses a little bit of magic to set the content
            before the "Add Another" button to be a new field. It takes the data
            passed in <span class="code">data-fields</span> and adds it to the DOM before the button.
            The <span class="code">event.preventDefault()</span> is there to prevent this button from
            also submitting the form.
          </p>
          <p>
            Removing a source field is just the opposite. In order to remove a
            source, all we need to do is remove the field from the DOM so its
            data is not sent over to the server when the form is submitted.
          </p>
          <script src="https://gist.github.com/dummycode/14cc22ec9dec82a7aa163b8116e5d5cb.js"></script>
          <p>
            Once again, be sure to include <span class="code">event.preventDefault()</span> so that the
            link doesn't redirect the user.
          </p>
          <p>
            The last thing we need to do is update the controller to permit
            these parameters to pass to the model. This is as easy as permitting
            <span class="code">:body</span> and <span class="code">sources: []</span>.
          </p>
          <script src="https://gist.github.com/dummycode/ab2f628a136fa46ea1c97969f6df461e.js"></script>
          <p>
            We now should be able to call <span class="code">@post.update(post_params)</span> to update
            the model. The only thing that may look slightly weird is the
            default params variable. The reason we need default params is
            because if you were to edit a post to have zero sources, the form
            would not actually send over a parameter for the sources, and thus
            the model would not overwrite whatever it had stored in there at the
            time. By doing this, we can ensure that the model updates to zero
            sources when the form does not send any over.
          </p>
          <p>
            Yay! We can now successfully add or delete sources that are backed
            by this JSONB array. Taking this a step further, what do we need to
            do if the array is an array of objects rather than an array of
            strings?
          </p>
        </div>
        <div class="section">
          <h4>An array of objects</h4>
          <p>
            Now that we have the initial setup down, especially the JavaScript,
            this is fairly easy. We just need to add another field to the form,
            name both fields in the source partial, and then permit these new
            parameters to the controller. If we wanted to have a title and URL
            for our source object, the new structure the controller expects is
            the following.
          </p>
          <script src="https://gist.github.com/dummycode/f4322a63e2330dbbc5187a8d2047e8e0.js"></script>
          <p>
            To accomplish this, we should add names to the fields inside the
            fields partial.
          </p>
          <script src="https://gist.github.com/dummycode/f8c994543def7f0f09b463b55fb6b1d0.js"></script>
          <p>
            And then permit both of those fields in the controller.
          </p>
          <script src="https://gist.github.com/dummycode/fc90707045be9af3d05f0b2c0647cbe8.js"></script>
          <p>
            Voila! We now have a working form to add or remove objects from an
            array stored in JSONB in Rails.
          </p>
          <p>
            Another little note before signing off, you can easily validate
            these attributes like normal on the model. The following is an
            example of how to prevent all titles and URLs from being empty.
          </p>
          <script src="https://gist.github.com/dummycode/010e593e1865321258b5948377056885.js"></script>
          <p>
            And that is all there is to it! With some fancier JavaScript, you
            should be able to get forms to work with any JSONB structure you
            have.
          </p>
        </div>
      </div>
    </div>
    <div id="sidebar-footer--mobile" class="sidebar-footer--mobile"></div>
  </body>
</html>
