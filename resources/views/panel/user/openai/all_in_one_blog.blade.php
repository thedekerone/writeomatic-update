@extends('panel.layout.app')
@section('title', 'All in One Blog Writer')
@section('additional_css')
<style>
.outer-div {
    padding-left: 10px;
    padding-right: 10px;
    padding-top: 4px;
    padding-bottom: 4px;
    background: rgba(28.32, 165.75, 132.77, 0.20);
    border-radius: 7px;
    justify-content: flex-start;
    align-items: center;
    gap: 6px;
    display: inline-flex
}

.inner-div {
    color: #20725E;
    font-size: 12px;
    font-family: SF Pro Text;
    font-weight: 500;
    word-wrap: break-word;
}

.tiles-wrapper {
    max-width: 800px;
    margin: auto;
}

.tile {
    position: relative;
    background-color: #F8F8F8;
    /* semi-transparent grey */
    padding: 40px;
    margin: 20px 0;
    border-radius: 10px;
    min-height: 600px;
    /* adding vertical height */
    min-width: 600px
}

.content-wrapper {
    display: flex;
    gap: 20px;
    /* Space between tiles and text editor */
    padding: 20px;
    justify-content: space-between;
}

.tiles-wrapper {
    flex: 1;
    max-width: 800px;
    /* Your existing max-width */
    /*... other existing styles ...*/
}

.editor-wrapper {
    flex: 1;
    /* Add styles for your text editor container here */
    /* Example: */
    padding: 20px;
    background-color: #f8f8f8;
    /* Or your preferred color */
    border-radius: 10px;
    min-height: 600px;
    /* Match with your tile min-height */
}

textarea,
input {
    width: calc(100%);
    /* width adjusted for padding */
    padding: 20px;
    margin-top: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
    height: 100px;
    /* adding vertical height to textareas */
}

.navigation-buttons {
    text-align: center;
}

.rect-btn {
    position: absolute;
    bottom: 10px;
    right: 10px;
    padding: 10px 20px;
    background-color: #330582;
    color: #fff;
    border: none;
    border-radius: 15px;
    cursor: pointer;
    font-size: 16px;
}

.rect-btn:hover {
    background-color: #5D389C;
    /* a slightly darker purple for hover effect */
}

.circle-btn {
    background-color: #5D389C;
    border: 2px solid #5D389C;
    color: white;
    padding: 15px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 18px;
    /* increasing arrow size */
    margin: 4px 12px;
    transition-duration: 0.4s;
    cursor: pointer;
    border-radius: 50%;
    width: 60px;
    /* increasing width */
    height: 60px;
    /* increasing height */

}

.circle-btn:hover {
    background-color: transparent;
    color: #5D389C;
}
</style>
@endsection

@section('content')
<div class="page-header">
    <div class="container-xl">
        <div class="row g-2 items-center">
            <div class="col">
                <a href="{{ LaravelLocalization::localizeUrl(route('dashboard.index')) }}"
                    class="page-pretitle flex items-center">
                    <svg class="!me-2 rtl:-scale-x-100" width="8" height="10" viewBox="0 0 6 10" fill="currentColor"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M4.45536 9.45539C4.52679 9.45539 4.60714 9.41968 4.66071 9.36611L5.10714 8.91968C5.16071 8.86611 5.19643 8.78575 5.19643 8.71432C5.19643 8.64289 5.16071 8.56254 5.10714 8.50896L1.59821 5.00004L5.10714 1.49111C5.16071 1.43753 5.19643 1.35718 5.19643 1.28575C5.19643 1.20539 5.16071 1.13396 5.10714 1.08039L4.66071 0.633963C4.60714 0.580392 4.52679 0.544678 4.45536 0.544678C4.38393 0.544678 4.30357 0.580392 4.25 0.633963L0.0892856 4.79468C0.0357141 4.84825 0 4.92861 0 5.00004C0 5.07146 0.0357141 5.15182 0.0892856 5.20539L4.25 9.36611C4.30357 9.41968 4.38393 9.45539 4.45536 9.45539Z" />
                    </svg>
                    {{__('Back to dashboard')}}
                </a>
                <h2 class="page-title mb-2">
                    {{__('All in One Blog Writer')}}
                </h2>
            </div>
        </div>
    </div>
</div>

<div class="content-wrapper">
    <div class="tiles-wrapper">
        <div class="tile" id="titleTile">
            <h1>Title</h1>
            <textarea id="titleText" placeholder="Generated or edit title here"></textarea>
            <button id="generateTitleBtn" class="rect-btn">Generate</button>
        </div>
        <div class="tile" id="descriptionTile" style="display:none;">
            <h1>Description</h1>
            <textarea id="descriptionText" placeholder="Generated or edit description here"></textarea>
            <button id="generateIntroBtn" class="rect-btn">Generate</button>
        </div>
        <div class="tile" id="tagsTile" style="display:none;">
            <h1>Tags</h1>
            <input type="text" id="tagsText" placeholder="Generated or edit tags here" />
            <button id="generateHeadingBtn" class="rect-btn">Generate</button>

        </div>

        <div class="navigation-buttons">
            <button id="prevBtn" class="circle-btn" disabled>◄</button>
            <button id="nextBtn" class="circle-btn">►</button>
        </div>
    </div>

    <div class="editor-wrapper">

    </div>

</div>


@endsection

@section('script')
<script>
const generateTitleBtn = document.getElementById("generateTitleBtn");
const generateIntroBtn = document.getElementById("generateIntroBtn");
const generateHeadingBtn = document.getElementById("generateHeadingBtn");

$(document).ready(function() {
    $('#generateTitleBtn').on('click', function() {
        var formData = new FormData();
        formData.append('post_type', '');
        // Add more formData appends here as per your requirements
        
        $.ajax({
            type: "post",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}",
            },
            url: "/dashboard/user/openai/generate",
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                console.log('Success:', data);
                // Additional code to execute upon successful API response
            },
            error: function (data){
                console.log('Error:', data);
                // Additional code to execute if the API call fails
            }
        });
    });
});



$('#generateTitle').on('input', function() {
    $('#proceedToDescription').prop('disabled', !$(this).val().trim());
});

// Add event listener for proceeding to the next step.
$('#proceedToDescription').on('click', function() {
    // Save the generated title and navigate/redirect user to the next step.
    localStorage.setItem('generatedTitle', $('#generateTitle').val().trim());
    window.location.href = '/path-for-description-generation'; // Update the path as per your route.
});

document.getElementById("nextBtn").addEventListener("click", function() {
    var titleTile = document.getElementById("titleTile");
    var descriptionTile = document.getElementById("descriptionTile");
    var tagsTile = document.getElementById("tagsTile");
    var prevBtn = document.getElementById("prevBtn");

    if (titleTile.style.display !== "none") {
        titleTile.style.display = "none";
        descriptionTile.style.display = "block";
        prevBtn.disabled = false;
    } else if (descriptionTile.style.display !== "none") {
        descriptionTile.style.display = "none";
        tagsTile.style.display = "block";
        this.disabled = true; // Disable next button at last step
    }
});

document.getElementById("prevBtn").addEventListener("click", function() {
    var titleTile = document.getElementById("titleTile");
    var descriptionTile = document.getElementById("descriptionTile");
    var tagsTile = document.getElementById("tagsTile");
    var nextBtn = document.getElementById("nextBtn");

    if (descriptionTile.style.display !== "none") {
        titleTile.style.display = "block";
        descriptionTile.style.display = "none";
        this.disabled = true; // Disable prev button at first step
    } else if (tagsTile.style.display !== "none") {
        descriptionTile.style.display = "block";
        tagsTile.style.display = "none";
        nextBtn.disabled = false;
    }
});
</script>
@endsection