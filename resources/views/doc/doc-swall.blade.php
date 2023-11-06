<div class="bg-white rounded-md p-6 shadow-md ">
    <h2 class="text-lg font-semibold mb-4 border-b-2 border-gray-300">Call Swall on Livewire</h2>

    <!-- start Swall using dispatchBrowserEvent component -->
    <x-general.accordion active="selected" tab="1" bg="white">
        <x-slot name="title">
            <div class="flex items-center p-4 space-x-2 font-semibold bg-gray-50 rounded-md">
                <p class="text-sm">Show Swall using dispatchBrowserEvent</p>
            </div>
        </x-slot>
        <x-slot name="content">
            <div class="border-t-2 px-6">
                <div class="bg-white shadow-lg p-4 my-4">
                    <x-form.basic-form wire:submit.prevent="submit">
                        <button type="submit" class="flex justify-center items-center p-2 text-sm bg-green-500 rounded-md focus:outline-none text-white">
                            Show Swall
                        </button>
                    </x-form.basic-form>
                </div>
                <p class="font-semibold">livewire.php code</p>
                <pre class="language-php -mt-4" wire:ignore>
                    <code class="language-php">
public function submit (){

    $this->dispatchBrowserEvent('swal',[
        'title' => 'Success!',
        'text'  => 'Success Message',
        'icon'  => 'success',
        'showConfirmButton' => false,
        'timer' => 1500,
    ]);
}
                    </code>
                </pre>
                <p class="font-semibold">livewire.blade.php code</p>
                <pre class="language-html -mt-4" wire:ignore >
                    <code class="language-html">
&lt;x-form.basic-form wire:submit.prevent="submit">
    &lt;button type="submit" class="flex justify-center items-center p-2 text-sm bg-green-500 rounded-md focus:outline-none text-white">
        Show Swall
    &lt;/button>
&lt;/x-form.basic-form>
                    </code>
                </pre>
            </div>
        </x-slot>
    </x-general.accordion>
    <!-- end Submit form component -->


    <!-- start Swall using session flash component -->
    <x-general.accordion active="selected" tab="2" bg="white">
        <x-slot name="title">
            <div class="flex items-center p-4 space-x-2 font-semibold bg-gray-50 rounded-md">
                <p class="text-sm">Show Swall using session flash</p>
            </div>
        </x-slot>
        <x-slot name="content">
            <div class="border-t-2 px-6">
                <div class="bg-white shadow-lg p-4 my-4">
                    <x-form.basic-form wire:submit.prevent="submit2">
                        <button type="submit" class="flex justify-center items-center p-2 text-sm bg-green-500 rounded-md focus:outline-none text-white">
                            Show Swall
                        </button>
                    </x-form.basic-form>
                    @if (session('error'))
                        <x-swall.error  message="{{ session('message') }}"/>
                    @elseif (session('info'))
                        <x-swall.info  message="{{ session('message') }}"/>
                    @elseif (session('success'))
                        <x-swall.success message="{{ session('message') }}"/>
                    @elseif (session('warning'))
                        <x-swall.warning  message="{{ session('message') }}"/>
                    @endif
                </div>
                <p class="font-semibold">livewire.php code</p>
                <pre class="language-php -mt-4" wire:ignore>
                    <code class="language-php">
public function submit2 (){

    session()->flash('message', 'Success Message');
    session()->flash('success');
    session()->flash('title', 'Success!');

    return redirect()->route('doc');
}
                    </code>
                </pre>
                <p class="font-semibold">livewire.blade.php code</p>
                <pre class="language-html -mt-4" wire:ignore >
                    <code class="language-html">
&lt;x-form.basic-form wire:submit.prevent="submit2">
    &lt;button type="submit" class="flex justify-center items-center p-2 text-sm bg-green-500 rounded-md focus:outline-none text-white">
        Show Swall
    &lt;/button>
&lt;/x-form.basic-form>
<h1>
&#x40;if (session('error'))
    &lt;x-swall.error  message="&#x7b;&#x7b; session('message') &#x7d;&#x7d;"/>
&#x40;elseif (session('info'))
    &lt;x-swall.info  message="&#x7b;&#x7b; session('message') &#x7d;&#x7d;"/>
&#x40;elseif (session('success'))
    &lt;x-swall.success message="&#x7b;&#x7b; session('message') &#x7d;&#x7d;"/>
&#x40;elseif (session('warning'))
    &lt;x-swall.warning  message="&#x7b;&#x7b; session('message') &#x7d;&#x7d;"/>
&#x40;endif
</h1>
                    </code>
                </pre>
            </div>
        </x-slot>
    </x-general.accordion>
    <!-- end Submit form component -->
</div>