<x-layouts.app :title="__('Addresses')">
    <x-table :data="$addresses" name="addresses" />
    <el-dialog>
        <dialog id="dialog" aria-labelledby="dialog-title"
            class="fixed inset-0 size-auto max-h-none max-w-none overflow-y-auto bg-transparent backdrop:bg-transparent">
            <el-dialog-backdrop
                class="fixed inset-0 bg-gray-900/50 transition-opacity data-closed:opacity-0 data-enter:duration-300 data-enter:ease-out data-leave:duration-200 data-leave:ease-in">
            </el-dialog-backdrop>
            <div tabindex="0"
                class="flex min-h-full items-end justify-center p-4 text-center focus:outline-none sm:items-center sm:p-0">
                <el-dialog-panel
                        class="relative transform overflow-hidden rounded-lg bg-zinc-900 text-left shadow-xl outline -outline-offset-1 outline-white/10 transition-all data-closed:translate-y-4 data-closed:opacity-0 data-enter:duration-300 data-enter:ease-out data-leave:duration-200 data-leave:ease-in sm:my-8 sm:w-full sm:max-w-lg data-closed:sm:translate-y-0 data-closed:sm:scale-95">
                        <form id="newCompanyForm" method="POST" action="/addresses">
                            @csrf
                            @method("POST")
                            <div class="bg-zinc-900 px-4 pt-5 pb-4 sm:p-6 sm:pb-4 sm:flex sm:items-start">
                                <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                                    <h3 id="dialog-title" class="text-base font-semibold text-white">Add New Address</h3>
                                    <div class="mt-4">
                                        <flux:input type="text" name="address" id="address" class="mb-2" required
                                            placeholder="Add Address" />
                                        <flux:input type="text" name="city" id="city" class="mb-2" required
                                            placeholder="Add City" />
                                        <flux:input type="text" name="postal_code" id="postal_code" class="mb-2" required
                                            placeholder="Add Postal-Code" />
                                        <flux:select name="company_id" required>
                                            <option value="" disabled selected>Select associated company</option>
                                            @foreach ($companies as $company)
                                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                                            @endforeach
                                        </flux:select>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-zinc-900 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
                                <button type="submit" id="saveNewTruck"
                                    class="inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-zinc-700 hover:bg-zinc-200 transition-colors sm:ml-3 sm:w-auto">Save</button>
                                <button type="button" id="closeDialog"
                                    class="mt-3 inline-flex w-full justify-center rounded-md bg-zinc-700 px-3 py-2 text-sm font-semibold text-white inset-ring inset-ring-white/5 hover:bg-zinc-600 transition-colors sm:mt-0 sm:w-auto">Cancel</button>
                            </div>
                        </form>
                </el-dialog-panel>
            </div>
        </dialog>
    </el-dialog>
</x-layouts.app>