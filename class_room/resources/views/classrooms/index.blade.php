<x-main-layout title="Classrooms">
<x-nav />

    <x-alert name="success" id="success" class="alert-success" />

    <div class="container mt-4 ">
        <div class="header d-flex justify-content-between">
            <div class="services mb-3">
                <i class="fa-solid fa-list-check " style="color: #4285f4"></i>
                <a href="#" class="ps-1">To do</a>

                <i class="fa-regular fa-rectangle-list ms-3" style="color: #4285f4"></i>
                <a href="#" class="ps-1">To review</a>

                <i class="fa-regular fa-calendar ms-3" style="color: #4285f4"></i>
                <a href="#" class="ps-1">Calender</a>
            </div>
        </div>

        <div class="container">
            <div class="classrooms m-3">
                <div class="row ms-3">
                    @foreach($classrooms as $classroom)
                    <x-card
                        :show="$classroom->url"
                        :name="$classroom->name"
                        :id="$classroom->id"
                        :section="$classroom->section"
                        :subject="$classroom->subject"
                        :room="$classroom->room"
                        :cover_image_path="$classroom->cover_image_path" 
/>  
                  @endforeach
                </div>
            </div>
        </div>

        {{-- how i can add content to stack
    @push('scripts')
    <script>alert(1)</script>
    @endPush
    --}}
</x-main-layout>