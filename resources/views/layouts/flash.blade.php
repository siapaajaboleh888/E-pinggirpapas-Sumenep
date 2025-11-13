<div id="flash-toasts" style="position: fixed; top: 80px; right: 16px; z-index: 9999; display: flex; flex-direction: column; gap: 10px; width: min(92vw, 380px);">
    @foreach (['success' => '#16a34a', 'warning' => '#f59e0b', 'error' => '#dc2626'] as $type => $color)
        @if (session($type))
            <div class="flash-toast" data-type="{{ $type }}" role="alert"
                 style="display:flex; align-items:flex-start; gap:10px; color:#0b1419; background:#fff; border-left:6px solid {{ $color }}; border-radius:12px; box-shadow:0 8px 24px rgba(0,0,0,0.12); padding:12px 14px;">
                <div style="flex-shrink:0; width:28px; height:28px; border-radius:8px; background: {{ $color }}20; display:flex; align-items:center; justify-content:center; color: {{ $color }}; font-size:16px;">
                    @if($type==='success') ✓ @elseif($type==='warning') ! @else ! @endif
                </div>
                <div style="flex:1; font-size:14px; line-height:1.35;">
                    {!! nl2br(e(session($type))) !!}
                </div>
                <button type="button" class="flash-close" aria-label="Close"
                        style="background:transparent; border:0; color:#64748b; font-size:18px; line-height:1; cursor:pointer; padding:2px 4px;">
                    ×
                </button>
            </div>
        @endif
    @endforeach
</div>
<script>
(function(){
  const container = document.getElementById('flash-toasts');
  if(!container) return;
  // Close handlers
  container.querySelectorAll('.flash-close').forEach(btn=>{
    btn.addEventListener('click', ()=>{
      const toast = btn.closest('.flash-toast');
      if (!toast) return;
      toast.style.transition = 'opacity .25s ease, transform .25s ease';
      toast.style.opacity = '0';
      toast.style.transform = 'translateY(-6px)';
      setTimeout(()=> toast.remove(), 250);
    });
  });
  // Auto dismiss after 4.5s
  container.querySelectorAll('.flash-toast').forEach((t, i)=>{
    t.style.opacity = '0';
    t.style.transform = 'translateY(-6px)';
    setTimeout(()=>{
      t.style.transition = 'opacity .25s ease, transform .25s ease';
      t.style.opacity = '1';
      t.style.transform = 'translateY(0)';
    }, 30 + i*60);
    setTimeout(()=>{
      t.style.transition = 'opacity .25s ease, transform .25s ease';
      t.style.opacity = '0';
      t.style.transform = 'translateY(-6px)';
      setTimeout(()=> t.remove(), 250);
    }, 4500 + i*400);
  });
})();
</script>
