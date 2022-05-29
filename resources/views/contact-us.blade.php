<x-layout>

    <x-nav-menu />

    @include ('posts._bread-crumb')
    
    @include ('posts._header')

    <main>
        <div class="max-w-7xl mx-auto p-4 py-6 sm:px-6 lg:px-8 body-text">
            <div class="max-w-7xl max-w-7xl mx-auto flex flex-col lg:flex-row justify-between">
            
                <form class="w-full flex-auto" method="post" action="{{ route('contact.store') }}">
                    <!-- Success message -->
                    @if(Session::has('success'))
                        <div x-data="{ open: true }" x-show="open" class="mb-8 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Success!</strong>
                            <span class="block sm:inline">{{Session::get('success')}}</span>
                            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                                <svg @click="open = false" class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                            </span>
                        </div>
                    @endif
                    <!-- CROSS Site Request Forgery Protection -->
                    @csrf
                    
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                            Name (*)
                            </label>
                            <input name="name" class="appearance-none block w-full text-gray-700 
                                @if ($errors->has('name')) 
                                    border border-red-500
                                @else
                                    border-gray-300
                                @endif 
                                rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" 
                                id="name" 
                                type="text" 
                                placeholder="Jane Doe"
                            >

                            <!-- Error -->
                            @if ($errors->has('name'))
                            <p class="text-red-500 text-xs italic">
                                {{ $errors->first('name') }}
                            </p>
                            @endif

                        </div>
                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="company">
                            Company
                            </label>
                            <input name="company" class="appearance-none block w-full text-gray-700 
                                @if ($errors->has('company')) 
                                    border border-red-500
                                @else
                                    border-gray-300
                                @endif 
                                rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" 
                                id="company" 
                                type="text" 
                                placeholder=""
                            >

                            <!-- Error -->
                            @if ($errors->has('company'))
                            <p class="text-red-500 text-xs italic">
                                {{ $errors->first('company') }}
                            </p>
                            @endif
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="email">
                            Email (*)
                            </label>
                            <input name="email" class="appearance-none block w-full text-gray-700 
                                @if ($errors->has('email')) 
                                    border border-red-500
                                @else
                                    border-gray-300
                                @endif  
                                rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" 
                                id="email" 
                                type="email" 
                                placeholder="contact@janedoe.com"
                            >
                            
                            <!-- Error -->
                            @if ($errors->has('email'))
                            <p class="text-red-500 text-xs italic">
                                {{ $errors->first('email') }}
                            </p>
                            @endif
                        </div>
                        <div class="w-full md:w-1/2 px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="phone">
                            Phone (*)
                            </label>
                            <input name="phone" class="appearance-none block w-full text-gray-700 
                                @if ($errors->has('phone')) 
                                    border border-red-500
                                @else
                                    border-gray-300
                                @endif 
                                rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" 
                                id="phone" 
                                type="text" 
                                placeholder=""
                            >

                            <!-- Error -->
                            @if ($errors->has('phone'))
                            <p class="text-red-500 text-xs italic">
                                {{ $errors->first('phone') }}
                            </p>
                            @endif
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="subject">
                            Subject (*)
                            </label>
                            <input name="subject" class="appearance-none block w-full text-gray-700 
                                @if ($errors->has('subject')) 
                                    border border-red-500
                                @else
                                    border-gray-300
                                @endif 
                                rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" 
                                id="subject" 
                                type="text" 
                                placeholder=""
                            >

                            <!-- Error -->
                            @if ($errors->has('subject'))
                            <p class="text-red-500 text-xs italic">
                                {{ $errors->first('subject') }}
                            </p>
                            @endif
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full px-3">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="message">
                            Message (*)
                            </label>
                            <textarea name="message" class="
                            no-resize appearance-none block w-full text-gray-700 border
                            @if ($errors->has('subject')) 
                                border border-red-500
                            @else
                                border-gray-300
                            @endif 
                            rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 h-48 resize-none"
                            id="message"></textarea>
                        
                            <!-- Error -->
                            @if ($errors->has('message'))
                            <p class="text-red-500 text-xs italic">
                                {{ $errors->first('message') }}
                            </p>
                            @endif
                        </div>
                    </div>
                    <div class="md:flex md:items-center">
                        <div class="w-full">
                            <button type="submit" name="send" class="w-full sm:w-64 lg:w-32 shadow bg-orange focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">
                            Send
                            </button>
                        </div>
                    <div class="md:w-2/3"></div>
                    </div>
                </form>

                <div class="hidden lg:block ml-10 w-1/2">
                    <h2 class="mb-6 pb-2 border-b-4 border-orange text-3xl font-bold text-gray-900 body-text">Contact Info</h2>

                    <div class="relative flex items-center mb-10">
                        <p class="text-lg leading-6 font-medium text-gray-900">
                        Please contact us by phone, text, or email to learn more
                        about our services and team. Everyone gets a free job quote
                        and we will come directly to you. We typically respond within
                        the same day and able to quote within two-three days.
                        </p>
                    </div>
                    <div class="relative flex items-center mb-10">
                        <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-orange text-white text-2xl">
                        <i class="fas fa-phone"></i>
                        </div>
                        <p class="ml-16 text-lg leading-6 font-medium text-gray-900"><a href="tel:+019053517947">+1 905-351-7947</a></p>
                    </div>
                    <div class="relative flex items-center">
                        <div class="absolute flex items-center justify-center h-12 w-12 rounded-md bg-orange text-white text-2xl">
                        <i class="fas fa-envelope"></i>
                        </div>
                        <p class="ml-16 text-lg leading-6 font-medium text-gray-900"><a href="mailto:contact@kimpaint.com">contact@kimpaint.com</a></p>
                    </div>
                </div>
                
            </div>
        </div>
    </main>
    <script src="./js/slider.js"></script>
</x-layout>