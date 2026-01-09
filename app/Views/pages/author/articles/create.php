<h1 class="text-3xl font-bold mb-6">Create Article</h1>

<div class="bg-gray-800 p-6 rounded-xl border border-gray-700">

<form method="post" action="/author/articles/create" class="space-y-5">

  <div>
    <label class="block mb-2 text-gray-400">Title</label>
    <input
      type="text"
      name="title"
      class="w-full bg-gray-900 border border-gray-600 px-4 py-2 rounded"
      placeholder="Article title"
    >
  </div>

  <div>
    <label class="block mb-2 text-gray-400">Content</label>
    <textarea
      name="content"
      rows="8"
      class="w-full bg-gray-900 border border-gray-600 px-4 py-2 rounded"
      placeholder="Write your article..."
    ></textarea>
  </div>

  <div>
    <label class="block mb-2 text-gray-400">Status</label>
    <select
      name="status"
      class="w-full bg-gray-900 border border-gray-600 px-4 py-2 rounded"
    >
      <option value="draft">Draft</option>
      <option value="published">Published</option>
    </select>
  </div>

  <button
    type="submit"
    class="bg-blue-600 hover:bg-blue-700 px-6 py-2 rounded"
  >
    Save
  </button>

</form>

</div>
