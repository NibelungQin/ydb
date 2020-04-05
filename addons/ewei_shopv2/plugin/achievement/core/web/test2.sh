#!/bin/bash
   
  function get_file(){
    local dir=$( ls $1)
    for file in $dir
    do
      local next_dir=$1"/"$file
    if [ -d $file ]
    then
       get_file $next_dir
    else
       echo $file
    fi

    done

  }
  get_file $1

