<div style="display: flex; justify-content: flex-start; align-items: center;">
    <a class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition mr-2"
        href="{{ route('assos.edit', $asso) }}"
    >Modifier</a>
    <form 
        action="{{ route('assos.delete', $asso) }}" 
        method="POST"
    >
        @csrf
        @method('delete')
        <button class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 transition">Supprimer</button>
    </form>
</div>
