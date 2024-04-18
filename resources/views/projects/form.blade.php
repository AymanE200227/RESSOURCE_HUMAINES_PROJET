<div class="form-group label-static is-empty">
    <label for="name" class="control-label">Name</label>
    <input type="text" class="form-control" name="name" placeholder="Interesting project name"
           value="{{ $project->name }}" autofocus>
</div>
<div class="form-group label-static is-empty">
    <label for="description" class="control-label">Description</label>
    <textarea class="form-control" name="description" placeholder="Description of the project">{{ $project->description }}</textarea>
</div>
<div class="form-group label-static is-empty">
    <label for="other_details" class="control-label">Other Details</label>
    <input type="text" class="form-control" name="other_details" placeholder="Other details of the project"
           value="{{ $project->other_details }}">
</div>
<div class="form-group label-static is-empty">
    <label for="estimated_duration" class="control-label">Estimated Duration</label>
    <input type="text" class="form-control" name="estimated_duration" placeholder="Estimated duration of the project"
           value="{{ $project->estimated_duration }}">
</div>
<div class="form-group label-static is-empty">
    <label for="budget" class="control-label">Budget</label>
    <input type="text" class="form-control" name="budget" placeholder="Budget for the project"
           value="{{ $project->budget }}">
</div>
<div class="form-group label-static is-empty">
    <label for="time_start" class="control-label">Start Time</label>
    <input type="text" class="form-control" name="time_start" placeholder="Start time of the project"
           value="{{ $project->time_start }}">
</div>
<div class="form-group label-static is-empty">
    <label for="image1" class="control-label">Image 1</label>
    <input type="text" class="form-control" name="image1" placeholder="Image 1 for the project"
           value="{{ $project->image1 }}">
</div>
<div class="form-group label-static is-empty">
    <label for="image2" class="control-label">Image 2</label>
    <input type="text" class="form-control" name="image2" placeholder="Image 2 for the project"
           value="{{ $project->image2 }}">
</div>
<div class="form-group label-static is-empty">
    <label for="image3" class="control-label">Image 3</label>
    <input type="text" class="form-control" name="image3" placeholder="Image 3 for the project"
           value="{{ $project->image3 }}">
</div>
<div class="form-group label-static is-empty">
    <label for="image4" class="control-label">Image 4</label>
    <input type="text" class="form-control" name="image4" placeholder="Image 4 for the project"
           value="{{ $project->image4 }}">
</div>
<div class="form-group label-static is-empty">
    <label for="file" class="control-label">File</label>
    <input type="text" class="form-control" name="file" placeholder="File for the project"
           value="{{ $project->file }}">
</div>
    