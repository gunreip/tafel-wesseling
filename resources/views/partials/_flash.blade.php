<div class="p-3 rounded bg-green-100 text-green-900" x-data="{show: true}" x-show="show" x-transition>
    {{ session("status") }}
    <button type="button" class="ml-2" @click="show=false">×</button>
</div>
