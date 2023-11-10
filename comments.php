<div class="well">
            <h4>Leave a Comment:</h4>
            <?php 
                insertComment();
            ?>
            <form role="form" action="" method="post">

                <div class="form-group">
                    <label for="author">Author</label>
                    <input type="text" id="comment_author" name="comment_author" class="form-control" placeholder="your name"></input>
                </div>
                <div class="form-group">
                <label for="email">email</label>
                    <input type="email" id="author_email" name="author_email" class="form-control" placeholder="your email"></input>
                </div>
                <div class="form-group">
                    <textarea id="comment_content" name="comment_content" class="form-control" rows="3"></textarea>
                </div>
                <button name="create_comment" type="submit" class="btn btn-primary">Submit</button>
            </form>
</div>