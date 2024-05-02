<script src="/js/socket.io.min.js"></script>

<!-- <script>
    const socket = io("http://192.168.22.48:3000/web");
</script> -->

<table class="relative w-full text-sm text-left border table-auto border-zinc-200 dark:border-zinc-600">
    <!-- TO DO -> add waiting mask and something to add size -->
    <thead class="font-medium text-gray-600 border-b dark:text-white dark:bg-zinc-900 dark:bg-opacity-50 bg-zinc-200">
        <tr>
            <th class="px-2 py-3 sm:px-4">Id</th>
            <th class="px-2 py-3 sm:px-4">Alias</th>
            <th class="px-2 py-3 sm:px-4">Status</th>
            <th class="hidden px-4 py-3 sm:table-cell">Owner</th>
            <th class="px-2 py-3 sm:px-4"></th>
        </tr>
    </thead>
    <tbody id="nodeTable" class="text-gray-600 divide-y dark:text-zinc-300">
    </tbody>
</table>