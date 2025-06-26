<?= view('admin/templates/header') ?>
<?= view('admin/templates/sidebar') ?>

<link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />

<div class="flex min-h-screen">
    <div class="flex-1 ml-64 p-6 mt-10">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

            <!-- ALERTS -->
            <?php if (session()->get('errors')): ?>
                <div class="mb-4 p-4 text-sm text-red-800 rounded-lg bg-red-100 dark:bg-red-200 dark:text-red-900">
                    <ul class="list-disc pl-5">
                        <?php foreach (session()->get('errors') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?php if (session()->get('message')): ?>
                <div class="mb-4 p-4 text-sm text-green-800 rounded-lg bg-green-100 dark:bg-green-200 dark:text-green-900">
                    <?= esc(session()->get('message')) ?>
                </div>
            <?php endif; ?>

            <!-- TOOLS -->
            <div class="flex justify-between items-center mb-4">
                <button data-modal-target="userModal" data-modal-toggle="userModal" onclick="resetForm()" class="text-white bg-blue-600 hover:bg-blue-700 font-medium rounded-lg text-sm px-5 py-2.5">
                    + Add User
                </button>
                <form action="<?= base_url('admin/user') ?>" method="get">
                    <input type="text" id="cariUser" onkeyup="filterUser()" placeholder="Cari ID Member..." class="border p-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </form>
            </div>

            <!-- TABLE -->
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th class="px-6 py-3 hidden">ID</th>
                        <th class="px-6 py-3">ID Member</th>
                        <th class="px-6 py-3">Nama</th>
                        <th class="px-6 py-3">Email</th>
                        <th class="px-6 py-3">role</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600">
                            <td class="px-6 py-4"><?= esc($user['id_member']) ?></td>
                            <td class="px-6 py-4"><?= esc($user['name']) ?></td>
                            <td class="px-6 py-4"><?= esc($user['email']) ?></td>
                            <td class="px-6 py-4"><?= esc($user['position']) ?></td>
                            <td class="px-6 py-4"><?= esc($user['status']) ?></td>
                            <td class="px-6 py-4">
                                <button data-modal-target="userModal" data-modal-toggle="userModal" onclick='editUser(<?= json_encode($user) ?>)' class="text-blue-600 hover:underline mr-2">
                                    Edit
                                </button>
                                <a href="<?= base_url('admin/user/hapus/' . $user['id']) ?>" class="text-red-600 hover:underline" onclick="return confirm('Yakin mau hapus user ini?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>
</div>

<!-- MODAL FORM -->
<div id="userModal" tabindex="-1" class="fixed inset-0 z-50 hidden overflow-y-auto overflow-x-hidden flex items-center justify-center">
    <div class="relative w-full max-w-md p-4">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-800">
            <!-- Header -->
            <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-700">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Form User</h3>
                <button type="button" class="text-gray-400 hover:text-gray-900 hover:bg-gray-200 rounded-lg p-1.5" data-modal-hide="userModal" onclick="resetForm()">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>

            <!-- Form -->
            <form id="userForm" action="<?= base_url('admin/user/simpan') ?>" method="post" class="p-6 space-y-5">
                <input type="hidden" name="_method" id="_method" value="post">
                <input type="hidden" name="id" id="id">

                <div>
                    <label for="id_member" class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">ID Member</label>
                    <input type="text" name="id_member" id="id_member" class="w-full p-2.5 bg-gray-100 text-sm rounded-lg border border-gray-300 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white" readonly>
                </div>
                <div>
                    <label for="name" class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Name</label>
                    <input type="text" name="name" id="name" class="w-full p-2.5 bg-white text-sm rounded-lg border border-gray-300 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                </div>
                <div>
                    <label for="email" class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                    <input type="email" name="email" id="email" class="w-full p-2.5 bg-white text-sm rounded-lg border border-gray-300 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                </div>
                <div>
                    <label for="password" class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Password</label>
                    <input type="password" name="password" id="password" class="w-full p-2.5 bg-white text-sm rounded-lg border border-gray-300 text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>
                <div>
                    <label for="position" class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Position</label>
                    <select name="position" id="position" class="w-full p-2.5 text-sm rounded-lg border border-gray-300 bg-white text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white" onchange="generateIdMember()" required>
                        <option value="">-- Pilih Position --</option>
                        <option value="Admin">Admin</option>
                        <option value="Member">Member</option>
                    </select>
                </div>
                <div>
                    <label for="status" class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                    <select name="status" id="status" class="w-full p-2.5 text-sm rounded-lg border border-gray-300 bg-white text-gray-900 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="Online">Online</option>
                        <option value="Offline">Offline</option>
                    </select>
                </div>
                <div class="flex justify-end pt-2">
                    <button type="submit" class="bg-blue-700 hover:bg-blue-800 text-white font-medium rounded-lg text-sm px-5 py-2.5">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- SCRIPT -->
<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

<script>
    function filterUser() {
        var input = document.getElementById("cariUser").value.toUpperCase();
        var rows = document.querySelectorAll("table tbody tr");

        rows.forEach(function(row) {
            var idMember = row.cells[0].textContent.toUpperCase();
            row.style.display = idMember.includes(input) ? "" : "none";
        });
    }

    function editUser(user) {
        document.getElementById('id').value = user.id;
        document.getElementById('id_member').value = user.id_member;
        document.getElementById('name').value = user.name;
        document.getElementById('email').value = user.email;
        document.getElementById('position').value = user.position;
        document.getElementById('status').value = user.status;
        document.getElementById('userForm').action = "<?= base_url('admin/user/update') ?>/" + user.id;
    }

    function resetForm() {
        document.getElementById('userForm').reset();
        document.getElementById('id').value = '';
        document.getElementById('id_member').value = '';
        document.getElementById('userForm').action = "<?= base_url('admin/user/simpan') ?>";
    }

    function generateIdMember() {
        const position = document.getElementById("position").value;
        if (position === "Member") {
            const id = "MBR" + Math.random().toString(36).substr(2, 4).toUpperCase();
            document.getElementById("id_member").value = id;
        } else {
            document.getElementById("id_member").value = '';
        }
    }
</script>