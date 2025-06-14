<?php
namespace App\Http\Controllers;

use App\Models\Forum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\ForumComment;

class ForumController extends Controller
{
    // 1. Menampilkan semua forum
    public function index()
    {
        $forums = Forum::latest()->with('pelajar')->get();
        return view('pelajar.forum.index', compact('forums'));
    }

    // 2. Form membuat forum baru
    public function create()
    {
        return view('pelajar.forum.create');
    }

    // 3. Simpan forum baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('forum_images', 'public');
        }

        Forum::create([
            'pelajar_id' => Auth::guard('pelajar')->id(),
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return redirect()->route('pelajar.forum.index')->with('success', 'Forum berhasil dibuat!');
    }

    // 4. Menampilkan detail forum
    public function show(Forum $forum)
{
    $comments = $forum->forumComments()->with('pelajar')->latest()->get();
    return view('pelajar.forum.show', compact('forum', 'comments'));
}


    // 5. Form edit forum (hanya untuk pemilik)
    public function edit(Forum $forum)
    {
        $pelajar = Auth::guard('pelajar')->user();

        if ($forum->pelajar_id !== $pelajar->id) {
            abort(403, 'Anda tidak diizinkan mengedit forum ini.');
        }

        return view('pelajar.forum.edit', compact('forum'));
    }

    // 6. Simpan perubahan forum
    public function update(Request $request, Forum $forum)
    {
        $pelajar = Auth::guard('pelajar')->user();

        if ($forum->pelajar_id !== $pelajar->id) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('forum_images', 'public');
        }

        $forum->update($validated);

        return redirect()->route('pelajar.forum.mine')->with('success', 'Forum berhasil diperbarui.');
    }

    // 7. Hapus forum
    public function destroy(Forum $forum)
    {
        $pelajar = Auth::guard('pelajar')->user();

        if ($forum->pelajar_id !== $pelajar->id) {
            abort(403);
        }

        $forum->delete();

        return redirect()->route('pelajar.forum.mine')->with('success', 'Forum berhasil dihapus.');
    }

    // 8. Menampilkan forum milik pelajar yang sedang login
    public function myForums()
    {
        $pelajar = Auth::guard('pelajar')->user();
        $forums = Forum::where('pelajar_id', $pelajar->id)->latest()->get();

        return view('pelajar.forum.mine', compact('forums'));
    }

   

public function storeComment(Request $request, Forum $forum)
{
    $request->validate([
        'content' => 'required|string',
    ]);

    ForumComment::create([
        'forum_id' => $forum->id,
        'pelajar_id' => Auth::guard('pelajar')->id(),
        'content' => $request->content,
    ]);

    return redirect()->route('pelajar.forum.show', $forum)->with('success', 'Komentar berhasil dikirim.');
}

}
