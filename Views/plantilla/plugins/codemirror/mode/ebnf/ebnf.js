odic_compaction_seconds=0
  blob_garbage_collection_age_cutoff=0.250000
  blob_garbage_collection_force_threshold=1.000000
  sample_for_compression=0
  bottommost_compression=kDisableCompressionOption
  compression_opts={enabled=false;max_dict_bytes=0;window_bits=-14;level=32767;parallel_threads=1;strategy=0;zstd_max_train_bytes=0;max_dict_buffer_bytes=0;use_zstd_dict_trainer=true;}
  max_write_buffer_number_to_maintain=0
  merge_operator=nullptr
  level_compaction_dynamic_level_bytes=false
  num_levels=7
  inplace_update_support=false
  min_write_buffer_number_to_merge=4
  optimize_filters_for_hits=false
  force_consistency_checks=true
  max_write_buffer_size_to_maintain=0
  bloom_locality=0
  comparator=leveldb.BytewiseComparator
  memtable_insert_with_hint_prefix_extractor=nullptr
  memtable_factory=SkipListFactory
  table_factory=BlockBasedTable
  compaction_filter=nullptr
  compaction_filter_factory=nullptr
  compaction_style=kCompactionStyleLevel
  compaction_pri=kMinOverlappingRatio
  sst_partitioner_factory=nullptr
  
[TableOptions/BlockBasedTable "queries"]
  pin_top_level_index_and_filter=true
  flush_block_policy_factory=FlushBlockBySizePolicyFactory
  cache_index_and_filter_blocks=false
  cache_index_and_filter_blocks_with_high_priority=true
  index_shortening=kShortenSeparators
  pin_l0_filter_and_index_blocks_in_cache=false
  index_type=kBinarySearch
  data_block_index_type=kDataBlockBinarySearch
  data_block_hash_table_util_ratio=0.750000
  checksum=kCRC32c
  no_block_cache=false
  block_size=4096
  block_size_deviation=10
  block_restart_interval=16
  index_block_restart_interval=1
  metadata_block_size=4096
  partition_filters=false
  optimize_filters_for_memory=false
  filter_policy=nullptr
  whole_key_filtering=true
  verify_compression=false
  detect_filter_construct_corruption=false
  format_version=5
  read_amp_bytes_per_bit=0
  block_align=false
  enable_index_compression=true
  metadata_cache_options={top_level_index_pinning=kFallback;unpartitioned_pinning=kFallback;partition_pinning=kFallback;}
  max_auto_readahead_size=262144
  prepopulate_block_cache=kDisable
  initial_auto_readahead_size=8192
  

[CFOptions "events"]
  blob_compaction_readahead_size=0
  blob_compression_type=kNoCompression
  hard_pending_compaction_bytes_limit=274877906944
  level0_file_num_compaction_trigger=4
  max_bytes_for_level_base=268435456
  report_bg_io_stats=false
  max_bytes_for_level_multiplier=10.000000
  disable_auto_compactions=false
  check_flush_compaction_key_order=true
  enable_blob_files=false
  paranoid_file_checks=false
  blob_file_starting_level=0
  blob_file_size=268435456
  soft_pending_compaction_bytes_limit=68719476736
  bottommost_compression_opts={enabled=false;max_dict_bytes=0;window_bits=-14;level=32767;parallel_threads=1;strategy=0;zstd_max_train_bytes=0;max_dict_buffer_bytes=0;use_zstd_dict_trainer=true;}
  max_compaction_bytes=1677721600
  max_sequential_skip_in_iterations=8
  level0_slowdown_writes_trigger=20
  level0_stop_writes_trigger=36
  bottommost_temperature=kUnknown
  max_write_buffer_number=16
  target_file_size_multiplier=1
  prefix_extractor=nullptr
  arena_block_size=4096
  inplace_update_num_locks=10000
  max_successive_merges=0
  memtable_huge_page_size=0
  write_buffer_size=1048576
  enable_blob_garbage_collection=false
  memtable_prefix_bloom_size_ratio=0.000000
  memtable_whole_key_filtering=false
  max_bytes_for_level_multiplier_additional=1:1:1:1:1:1:1
  target_file_size_base=67108864
  min_blob_size=0
  compression=kNoCompression
  compaction_options_fifo={allow_compaction=false;max_table_files_size=1073741824;age_for_warm=0;}
  compaction_options_universal={allow_trivial_move=false;max_size_amplification_percent=200;size_ratio=1;incremental=false;stop_style=kCompactionStopStyleTotalSize;min_merge_width=2;compression_size_percent=-1;max_merge_width=4294967295;}
  ttl=2592000
  periodic_compaction_seconds=0
  blob_garbage_collection_age_cutoff=0.250000
  blob_garbage_collection_force_threshold=1.000000
  sample_for_compression=0
  bottommost_compression=kDisableCompressionO         }
            }
          }
          return token;
        }

        //no stack
        switch (peek) {
        case "[":
          stream.next();
          state.stack.unshift(stateType.characterClass);
          return "bracket";
        case ":":
        case "|":
        case ";":
          stream.next();
          return "operator";
        case "%":
          if (stream.match("%%")) {
            return "header";
          } else if (stream.match(/[%][A-Za-z]+/)) {
            return "keyword";
          } else if (stream.match(/[%][}]/)) {
            return "matchingbracket";
          }
          break;
        case "/":
          if (stream.match(/[\/][A-Za-z]+/)) {
          return "keyword";
        }
        case "\\":
          if (stream.match(/[\][a-z]+/)) {
            return "string-2";
          }
        case ".":
          if (stream.match(".")) {
            return "atom";
          }
        case "*":
        case "-":
        case "+":
        case "^":
          if (stream.match(peek)) {
            return "atom";
          }
        case "$":
          if (stream.match("$$")) {
            return "builtin";
          } else if (stream.match(/[$][0-9]+/)) {
            return "variable-3";
          }
        case "<":
          if (stream.match(/<<[a-zA-Z_]+>>/)) {
            return "builtin";
          }
        }

        if (stream.match(/^\/\//)) {
          stream.skipToEnd();
          return "comment";
        } else if (stream.match(/return/)) {
          return "operator";
        } else if (stream.match(/^[a-zA-Z_][a-zA-Z0-9_]*/)) {
          if (stream.match(/(?=[\(.])/)) {
            return "variable";
          } else if (stream.match(/(?=[\s\n]*[:=])/)) {
            return "def";
          }
          return "variable-2";
        } else if (["[", "]", "(", ")"].indexOf(stream.peek()) != -1) {
          stream.next();
          return "bracket";
        } else if (!stream.eatSpace()) {
          stream.next();
        }
        return null;
      }
    };
  });

  CodeMirror.defineMIME("text/x-ebnf", "ebnf");
});
