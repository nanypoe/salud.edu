efault-viz.quads disabled-by-default-viz.surface_id_flow disabled-by-default-viz.surface_lifetime disabled-by-default-viz.triangles disabled-by-default-viz.visual_debugger disabled-by-default-webaudio.audionode disabled-by-default-webgpu disabled-by-default-webnn disabled-by-default-webrtc disabled-by-default-worker.scheduler disabled-by-default-xr.debug android_webview,toplevel android_webview.timeline,android.ui.jank base,toplevel benchmark,drm benchmark,latencyInfo,rail benchmark,latencyInfo,rail,input.scrolling benchmark,loading benchmark,rail benchmark,uma benchmark,ui benchmark,viz benchmark,viz,disabled-by-default-display.framedisplayed blink,benchmark blink,benchmark,rail,disabled-by-default-blink.debug.layout blink,blink.resource blink,blink_style blink,devtools.timeline blink,loading blink,rail blink.animations,devtools.timeline,benchmark,rail blink.user_timing,rail browser,content,navigation browser,navigation browser,navigation,benchmark browser,startup category1,category2 cc,benchmark cc,benchmark,input,input.scrolling cc,benchmark,disabled-by-default-devtools.timeline.frame cc,input cc,raf_investigation cc,disabled-by-default-devtools.timeline content,navigation devtools.timeline,rail drm,hwoverlays dwrite,fonts fonts,ui gpu,benchmark gpu,benchmark,android_webview gpu,benchmark,webview gpu,login gpu,startup gpu,toplevel.flow gpu.angle,startup inc2,inc inc,inc2 input,benchmark input,benchmark,devtools.timeline input,benchmark,devtools.timeline,latencyInfo input,benchmark,latencyInfo input,latency input,rail input,input.scrolling input,views interactions,startup ipc,security ipc,toplevel Java,devtools,disabled-by-default-devtools.timeline loading,interactions loading,rail loading,rail,devtools.timeline login,screenlock_monitor media,gpu media,rail navigation,benchmark,rail navigation,rail renderer,benchmark,rail renderer,webkit renderer_host,navigation renderer_host,disabled-by-default-viz.surface_id_flow scheduler,devtools.timeline,loading shutdown,viz startup,benchmark,rail startup,rail toplevel,Java toplevel,viz ui,input ui,latency ui,toplevel v8,disabled-by-default-v8.compile v8,devtools.timeline v8,devtools.timeline,disabled-by-default-v8.compile viz,benchmark viz,benchmark,graphics.pipeline WebCore,benchmark,rail disabled-by-default-cc.debug,disabled-by-default-viz.quads,disabled-by-default-devtools.timeline.layers disabled-by-default-cc.debug.display_items,disabled-by-default-cc.debug.picture,disabled-by-default-devtools.timeline.picture disabled-by-default-v8.inspector,disabled-by-default-v8.stack_trace ScopedMayLoadLibraryAtBackgroundPriority : Priority Increased ScopedMayLoadLibraryAtBackgroundPriority NOTREACHED hit.  Check failed: false.  ..\..\base\check.cc TriggerNotReached NOTREACHED log messages are omitted in official builds. Sorry! Logging-FATAL_MILESTONE Logging-DUMP_WILL_BE_CHECK_MESSAGE Logging-NOTREACHED_MESSAGE ScopedBlockingCall ScopedBlockingCallWithBaseSyncPrimitives 0123456789ABCDEF..\..\base\win\security_util.cc AddACEToPath    EnforceNoExecutableFileHandles NotReachedIsFatal CR_SOURCE_ROOT g e n   b a s e   t e s t   d a t a   ������g��	�����������j	��g��*	��v	��M i c r o s o f t   I n t e r n e t   E x p l o r e r   Q u i c k   L a u n c h   U s e r   P i n n e d   T a s k B a r   I m p l i c i t A p p S h o r t c u t s   ?��d
���
���
���
���
���
������
�����C���
��^�����x��
��9�������������I����� ��������t��������     �ۺ �ۺ �ۺ �ۺ..\..\third_party\libc++\src\include\__memory\assume_aligned.h:34: assertion reinterpret_cast<uintptr_t>(__ptr) % _Np == 0 failed: Alignment assumption is violated
    ^��X��8 ��� ��r �� \/ -inl     ��
 �� �� ��������H ��%j��j��j��j��j��j��j��j��j��j��j��j��j��j��j��j��,j��S o f t w a r e \ G o o g l e \ U p d a t e \ C l i e n t s \   S o f t w a r e \ G o o g l e \ U p d a t e \ C l i e n t S t a t e \   IsWow64Process  W O W 6 4 3 2 N o d e \         \ W O W 6 4 3 2 N o d e         �u@                  �u@          �v@                 �v@   6       S O F T W A R E \ C l a s s e s        return null;
    };


    // Handle non-detected items
    stream.next();
    return 'error';
  };


  return {
    startState: function() {
      return {
        tokenize: tokenBase
      };
    },

    token: function(stream, state) {
      var style = state.tokenize(stream, state);
      if (style === 'number' || style === 'variable'){
        state.tokenize = tokenTranspose;
      }
      return style;
    },

    lineComment: '%',

    fold: 'indent'
  };
});

CodeMirror.defineMIME("text/x-octave", "octave");

});
