<fieldset style="width:543px;" >
    <legend><i class="facebox-header"><i class="edit large icon"></i>&nbsp;Update Question</i></legend>

    <div class="col-md-12 mt-4">
        <form method="post" action="<?php echo URLROOT . '/exam/update/' . $data['question_id']; ?>" id="updateQuestionFrm">
            <div class="form-group">
                <legend>Question</legend>
                <input type="hidden" name="question_id" value="<?php echo $data['question_id']; ?>">
                <textarea name="question" class="form-control" rows="2" required=""><?php echo $data['exam_question']; ?></textarea>
            </div>

            <div class="form-group">
                <legend>Choice A</legend>
                <input type="text" name="exam_ch1" value="<?php echo $data['exam_ch1']; ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <legend>Choice B</legend>
                <input type="text" name="exam_ch2" value="<?php echo $data['exam_ch2']; ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <legend>Choice C</legend>
                <input type="text" name="exam_ch3" value="<?php echo $data['exam_ch3']; ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <legend>Choice D</legend>
                <input type="text" name="exam_ch4" value="<?php echo $data['exam_ch4']; ?>" class="form-control" required>
            </div>

            <div class="form-group">
                <legend class="text-success">Correct Answer</legend>
                <input type="text" name="exam_final" value="<?php echo $data['exam_answer']; ?>" class="form-control" required>
            </div>

            <div class="form-group" align="right">
                <button type="submit" class="btn btn-sm btn-primary">Update Now</button>
            </div>
        </form>
    </div>
</fieldset>
