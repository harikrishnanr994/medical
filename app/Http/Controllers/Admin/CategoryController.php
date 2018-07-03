<?php

namespace App\Http\Controllers\Admin;

use App\BrandCategory;
use App\Category;
use App\CategorySpecification;
use App\Control;
use App\Product;
use App\SpecTitle;
use App\ThemeSpec;
use App\VariationSpec;
use App\VariationTheme;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PhpParser\Node\Expr\Array_;

class CategoryController extends Controller
{
    public function indexCategory()
    {
        $categories= Category::with('category_details')->get();
        $categories->map(function ($category) use($categories){

            $last_parent=$category->parent_id;
            $child=$category->id;

            $grand_parent_cat[]=$child;
            $category->parent_text = "";
            $last_parent_name='';
            do
            {
                $grand_parent_cat[]=$last_parent;
                for ($i=0;$i<count($categories);$i++)
                {
                    if($categories[$i]['id']==$last_parent)
                    {
                        $last_parent=$categories[$i]['parent_id'];
                        $last_parent_name=$categories[$i]['name'];
                    }
                }
                if($last_parent_name=="")
                {
                    $category->parent_text = $last_parent_name;
                }
                else
                {
                    $category->parent_text .= ' >> '.$last_parent_name;
                }

            } while( $last_parent!=0 );
            if($category->parent_text!='')
            {
                $rev_arr=explode(' >> ',$category->parent_text);
                $rev_arr=array_reverse($rev_arr);
                $category->parent_text=implode(" >> ",$rev_arr);
                $category->parent_text= substr($category->parent_text, 0, -3);;
            }

        });
        return view('admin.category.index', compact('categories'));
    }
    public function createCategory()
    {
        // $categories= Category::all();
        $controls=Control::all();
        $categories= Category::where('parent_id','0')->where('is_deleted','!=',1)->get();
        return view('admin.category.create', compact('categories','controls'));
    }
    public function storeCategory(Request $request)
    {
        if($request->parent_name=='')
        {
            $this->validate($request, [
                'name' => 'required|unique:categories',
                'image' => 'required',
                'image2' => 'required'
            ]);
        }
        else
        {
            if (isset($request->last_child))
            {
                $this->validate($request, [
                    'name' => 'required|unique:categories',
                    'specification_titles' => 'required',
                ]);
            }
            //  if (isset($request->not_a_last_child))
            else
            {
                $this->validate($request, [
                    'name' => 'required|unique:categories',
                ]);
            }

        }



        //generate fbin
        $fbin = str_random(8);
        while (1){
            $fbinExist = Category::where('fbin', $fbin)->first();
            if(!$fbinExist)
                break;
            else
                $fbin = str_random(8);
        }
        $fbin=strtoupper($fbin);
        $fbin='CAT'.$fbin;

        $input=$request->all();
        $file=$request->file('image');
        $file2=$request->file('image2');

        // dd($input);
        $input['image'] = '';
        $input['image2'] = '';
        if(count($file)){
            $path = $file->storeAs('/category', str_slug('category') . mt_rand() . '.' . $file->extension(), 'uploads');
            $input['image'] = $path;
        }
        if(count($file2)){
            $path2 = $file2->storeAs('/categoryIcons', str_slug('categoryIcon') . mt_rand() . '.' . $file2->extension(), 'uploads');
            $input['image2'] = $path2;
        }
        //$category=Category::create($input);
        $category=Category::create(['fbin'=>$fbin,
            'name'=>$input['name'],
            'image'=>$input['image'],
            'icon'=>$input['image2'],
            'parent_id'=>$input['parent_id'],
            'parent_name'=>$input['parent_name']
        ]);
        $specification_titles_arr=explode(",",$input['specification_titles']);
        for ($i=0;$i<count($specification_titles_arr);$i++)
        {
            $category123=SpecTitle::create(['category_id'=>$category->id,
                'spec_title'=>$specification_titles_arr[$i]]);
        }

        if($request->parent_name=='' || isset($request->not_a_last_child))
        {
            flash('Category added successfully ..')->important()->success();
            return redirect()->route('category.index');
        }
        else
        {
            $id=$category->id;
            $category=$input['name'];

            $controls=Control::all();
            $titles=SpecTitle::where('category_id',$id)->get();
            return view('admin.category.specifications2',compact('controls','category','id','titles'));
        }


    }

    public function editCategory($id)
    {
        $datas=Category::where('id',$id)->first();

        $categories_all = Category::all();
        $last_parent=$datas->parent_id;
        $child=$datas->id;

        $grand_parent_cat[]=$child;
        $datas->parent_text = "";
        $last_parent_name='';
        do
        {
            $grand_parent_cat[]=$last_parent;
            for ($i=0;$i<count($categories_all);$i++)
            {
                if($categories_all[$i]['id']==$last_parent)
                {
                    $last_parent=$categories_all[$i]['parent_id'];
                    $last_parent_name=$categories_all[$i]['name'];
                }
            }
            if($last_parent_name=="")
            {
                $datas->parent_text = $last_parent_name;
            }
            else
            {
                $datas->parent_text .= ' >> '.$last_parent_name;
            }

        } while( $last_parent!=0 );
        if($datas->parent_text!='')
        {
            $rev_arr=explode(' >> ',$datas->parent_text);
            $rev_arr=array_reverse($rev_arr);
            $datas->parent_text=implode(" >> ",$rev_arr);
            $datas->parent_text= substr($datas->parent_text, 0, -3);;
        }


        $categories= Category::where('parent_id','0')->where('is_deleted','!=',1)->get();
        $spec_titles= SpecTitle::where('category_id',$id)->where('is_deleted','!=',1)->get();
        if($spec_titles)
        {
            for($i=0;$i<count($spec_titles);$i++)
            {
                $spec_arr[]=$spec_titles[$i]->spec_title;
            }
            $spec=implode(",",$spec_arr);

        }
        else
        {
            $spec='';
        }

        //dd($spec);
        return view('admin.category.edit', compact('categories','datas','id','spec'));
    }
    public function updateCategory(Request $request,$id)
    {
        $this->validate($request, [
            'name' => 'required|unique:categories,name,'.$id
        ]);
        //dd($request->file('image2'));
        /* if($request->specification_titles)
         {
             $this->validate($request, [
                 'specification_titles' =>'unique'
             ]);

         }*/
        $input=$request->all();
        $parent=$request->parent_id;
        $file=$request->file('image');
        $file2=$request->file('image2');
        if(count($file) || count($file2)){
            if (count($file))
            {
                $path = $file->storeAs('/category', str_slug('category') . mt_rand() . '.' . $file->extension(), 'uploads');
                $input['image'] = $path;
            }

            if (count($file2))
            {
                $path2 = $file2->storeAs('/categoryIcons', str_slug('categoryIcon') . mt_rand() . '.' . $file2->extension(), 'uploads');
                $input['icon'] = $path2;
            }


            $category = Category::findOrFail($id);
            $category->update($input);

            if($input['specification_titles'] !='')
            {
                $check_arr=SpecTitle::select('spec_title')->where('category_id',$id)->get();
                for($j=0;$j<count($check_arr);$j++)
                {
                    $new_check_arr[]=$check_arr[$j]->spec_title;
                }
                $specification_titles_arr=explode(",",$input['specification_titles']);
                for ($i=0;$i<count($specification_titles_arr);$i++)
                {
                    if (!in_array($specification_titles_arr[$i], $new_check_arr))
                    {
                        $category=SpecTitle::create(['category_id'=>$id,
                            'spec_title'=>$specification_titles_arr[$i]]);
                    }

                }
            }


            /*  flash('Category has been updated')->important()->success();
              return redirect()->route('category.index');*/
        }

        else
        {
            if($input['specification_titles'] !='')
            {
                $check_arr=SpecTitle::select('spec_title')->where('category_id',$id)->get();
                for($j=0;$j<count($check_arr);$j++)
                {
                    $new_check_arr[]=$check_arr[$j]->spec_title;
                }
                $specification_titles_arr=explode(",",$input['specification_titles']);
                for ($i=0;$i<count($specification_titles_arr);$i++)
                {
                    if (!in_array($specification_titles_arr[$i], $new_check_arr))
                    {
                        $category=SpecTitle::create(['category_id'=>$id,
                            'spec_title'=>$specification_titles_arr[$i]]);
                    }

                }
            }

            Category::where('id',$id)->update(array('name' =>$request->name ,'parent_id' =>$request->parent_id,'parent_name' =>$request->parent_name));

        }
        flash('Category has been updated')->important()->success();
        return redirect()->route('category.index');

    }
    public function updatenonEditCategory(Request $request,$id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $input=$request->all();
        $parent = $request->parent_id;
        $file = $request->file('image');
        $file2 = $request->file('image2');
        if (count($file) || count($file2)) {
            if (count($file)) {
                $path = $file->storeAs('/category', str_slug('category') . mt_rand() . '.' . $file->extension(), 'uploads');
                $input['image'] = $path;
            }

            if (count($file2)) {
                $path2 = $file2->storeAs('/categoryIcons', str_slug('categoryIcon') . mt_rand() . '.' . $file2->extension(), 'uploads');
                $input['icon'] = $path2;
            }

        }
        $category = Category::findOrFail($id);
        $category->update($input);
        flash('Category has been updated')->important()->success();
        return redirect()->route('category.index');
    }
    public function destroyCategory(Request $request)
    {
        $category=Category::where('parent_id',$request->category_id)->first();
        if($category)
        {
            return response()->json(false);
        }
        else
        {
            $category=Product::where('category_id',$request->category_id)->first();
            if ($category)
            {
                return response()->json(false);
            }
            else
            {

                Category::where('id',$request->category_id)->delete();
                return response()->json(true);
            }
        }


    }

    public function updateStatus(Request $request)
    {
        $category_id=$request->category_id;



        if($request->status==0)
        {
            $category=Category::find($category_id);

            $categories = Category::where('is_deleted', 0)->orderBy('id')->get()->toArray();
            $tree = $this->_buildTree($categories, 'parent_id', 'id');

            $cats =  $this->_getCatChild($category->name, $tree, true);


            Category::whereIn('id',$cats)->update(array('is_deleted'=>'1'));
        }
        else
        {
            $category=Category::find($category_id);

            $categories = Category::where('is_deleted', 1)->orderBy('id')->get()->toArray();
            $tree = $this->_buildTree($categories, 'parent_id', 'id');


            $cats =  $this->_getCatChild($category->name, $tree, true);

            Category::whereIn('id',$cats)->update(array('is_deleted'=>'0'));
        }
        return response()->json(true);
    }

    //returns a parent-child tree
    private function _buildTree($flat, $pidKey, $idKey = null)
    {
        $grouped = array();
        foreach ($flat as $sub){
            $grouped[$sub[$pidKey]][] = $sub;
        }

        $fnBuilder = function($siblings) use (&$fnBuilder, $grouped, $idKey){
            foreach ($siblings as $k => $sibling){
                $id = $sibling[$idKey];
                if(isset($grouped[$id])){
                    $sibling['sub_cat'] = $fnBuilder($grouped[$id]);
                }
                $siblings[$k] = $sibling;
            }

            return $siblings;
        };
//        $tree = $fnBuilder($grouped[0]);
        $tree = $fnBuilder($grouped[current(array_keys($grouped))]);
        return $tree;
    }

    //get category children
    private function _getCatChild($parent, $catTree, $idOnly = false)
    {
        $ids = [];
        $getId = function($group) use (&$getId, &$ids){
            foreach ($group as $key => $item) {
                if($key == 'id') {
                    $ids[] = $item;
                }elseif(is_array($item)){
                    foreach ($item as $child) {
                        $getId($child);
                    }
                }
            }
        };

        $pc = '';
        foreach ($catTree as $cat){
            if (mb_strtolower($cat['name']) == mb_strtolower($parent)){
                if($idOnly) {
                    $getId($cat);
                    return $ids;
                }else{
                    return $cat;
                }
            }else{
                if (isset($cat['sub_cat']) || !empty($cat['sub_cat'])){
                    $pc = $this->_getCatChild($parent, $cat['sub_cat'], $idOnly);
                    if($pc)
                        return $pc;
                }
            }
        }
    }

    public function getSubCategory(Request $request)
    {
        $main_category_id = $request->category;
        $parent_name = Category::where('id', $main_category_id)->where('is_deleted', 0)->get();
        $sub_categories = Category::where('parent_id', $main_category_id)->where('is_deleted', 0)->get();

        return response()->json([
            'sub_categories' => $sub_categories,
            'parent_name' => $parent_name
        ]);
    }

    public function subCat(Request $request)
    {
        $category_id=$request->category;
        $parent_name=Category::where('id',$category_id)->where('is_deleted','!=',1)->get();
        $sub_categories=Category::where('parent_id',$category_id)->where('is_deleted','!=',1)->get();

        return response()->json([
            'sub_categories' => $sub_categories,
            'parent_name' => $parent_name
        ]);
    }

    public function categorySpec(Request $request,$id,$category)
    {
        $controls=Control::all();
        $titles=SpecTitle::where('category_id',$id)->where('is_deleted','!=',1)->get();
        /*
              $category_used=Category::where('parent_id',$id)->where('is_deleted','!=',1)->first();
              if(!$category_used)
              {
                  $category_used=Product::where('category_id',$id)->first();
              }*/

        return view('admin.category.specifications2',compact('controls','category','id','titles'));
    }
    public function getSpecifications(Request $request)
    {
        $category_id = $request->category_id;
        $data=CategorySpecification::where('category_id',$category_id)->where('is_deleted','!=',1)->get();
        return response()->json($data);
    }
    public function categorySpecStore(Request $request)
    {
        $inputs=$request->all();
        $controls=Control::where('id',$inputs['control'])->first();
        $inputs['control_name']=$controls['input'];
        // CategorySpecification::create($inputs);
        CategorySpecification::create(['category_id'=> $inputs['category_id'],
            'spec_name'=> $inputs['spec_name'],
            'specifications'=>$inputs['specifications'],
            'control'=> $inputs['control'],
            'control_name'=> $inputs['control_name'],
            'search_control'=> $inputs['control'],
            'spec_title'=> $inputs['spec_title'],

        ]);
        $data=CategorySpecification::where('category_id',$inputs['category_id'])->where('is_deleted','!=',1)->get();
        return response()->json($data);
    }
    public function categorySpecEdit(Request $request)
    {
        $details=CategorySpecification::where('id',$request->id)->where('is_deleted','!=',1)->get();
        return response()->json($details);
    }
    public function categorySpecUpdate(Request $request)
    {
        $inputs=$request->all();
        $controls=Control::where('id',$inputs['control'])->first();
        $inputs['control_name']=$controls['input'];

        $id=$request->id;
        $cat_spec=CategorySpecification::find($id);
        $old_cat_spec=$cat_spec['specifications'];
        if($request->specifications != '')
        {
            $specifications = $old_cat_spec.','.$request->specifications;
        }
        else
        {
            $specifications = $old_cat_spec;
        }
        $inputs['specifications']=$specifications;

        CategorySpecification::find($id)->update($inputs);

        return response()->json(true);
    }
    public function categorySpecDelete(Request $request)
    {
        $id=$request->id;

        $check=ThemeSpec::where('category_spec_id',$id)->first();
        if($check)
        {
            $msg="Sorry the spcification is already in use !! ";
            return response()->json($msg);
        }
        else
        {
            CategorySpecification::find($id)->delete();
            $msg="Deleted successfully";
            return response()->json($msg);

        }

    }

    public function addCategoryVariation()
    {
        $cat_spec_arr=CategorySpecification::select('category_id')->distinct()->get()->pluck('category_id');

        $categories=Category::whereIn('id',$cat_spec_arr)->where('is_deleted','!=',1)->get();
        $variations=VariationTheme::with('category_details')->get();

        return view('admin.category.category_variation',compact('categories','variations'));
    }
    public function getCategoryVariations(Request $request)
    {
        $category_id=$request->category_id;
        $category=Category::where('id',$category_id)->first();
        $category_name=$category['name'];

        $theme_specs=VariationTheme::with('theme_specs','theme_specs.variation_specs')->where('category_id',$category_id)->first();
        if($theme_specs)
        {
            $theme_specs_test=$theme_specs->toArray();
        }
        else
        {
            $theme_specs_test=array();
        }



        $used='false';
        if($theme_specs_test)
        {
            for ($i=0;$i<count($theme_specs_test['theme_specs']);$i++)
            {
                for ($j=0;$j<count($theme_specs_test['theme_specs'][$i]['variation_specs']);$j++)
                {
                    if($theme_specs_test['theme_specs'][$i]['variation_specs'][$j])
                    {
                        $used='true';
                        break;
                    }
                }
            }
        }


        $specs=CategorySpecification::where('category_id',$category_id)->where('is_deleted','!=',1)->get();
        return view('admin.category.theme_page',compact('theme_specs','category_id','category_name','specs','used'));
    }
    /*$theme_specs=VariationTheme::with('theme_specs','theme_specs.variation_specs')->where('category_id',$category_id)->first();
    $theme_specs_test=$theme_specs->toArray();


    $used='false';
    if($theme_specs_test)
    {
    for ($i=0;$i<count($theme_specs_test['theme_specs']);$i++)
    {
    for ($j=0;$j<count($theme_specs_test['theme_specs'][$i]['variation_specs']);$j++)
    {
    if($theme_specs_test['theme_specs'][$i]['variation_specs'][$j])
    {
    $used='true';
    break;
    }
    }
    }
    }*/

    public function createThemeSpec(Request $request)
    {
        $res=VariationTheme::where('category_id',$request->category_id)->first();



        if(count($res))
        {
            $theme_id= $res['theme_id'];
            VariationTheme::where('theme_id',$theme_id)->update(array('theme_name'=>$request->theme_name));

            $check_duplication=ThemeSpec::where('theme_id',$theme_id)->get();
            $category_spec_id_arr=array();
            for ($i=0;$i<count($check_duplication);$i++)
            {
                $category_spec_id_arr[]=$check_duplication[$i]->category_spec_id;
            }

            for($i=0;$i<count($request->variants);$i++)
            {
                if(!in_array($request->variants[$i],$category_spec_id_arr))
                {
                    ThemeSpec::create(['theme_id'=>$theme_id,
                        'category_spec_id'=>$request->variants[$i],
                    ]);
                }

            }
            //dd($request->variants);

            if(count($request->variants))
            {
                $unwanted_variants=array_diff($category_spec_id_arr,$request->variants);
                $unwanted_variants = array_values($unwanted_variants);
            }
            else
            {
                $unwanted_variants = array_values($category_spec_id_arr);
            }



            $theme_specs=ThemeSpec::where('theme_id',$theme_id)->get();

            $variation_specs=VariationSpec::get()->pluck('theme_spec_id')->toArray();//used or not by product
            $variation_specs = array_values($variation_specs);

            if($theme_specs)
            {
                for ($i=0;$i<count($theme_specs);$i++)
                {
                    if (in_array($theme_specs[$i]->category_spec_id, $unwanted_variants))
                    {
                        if (!in_array($theme_specs[$i]->theme_spec_id, $variation_specs))
                        {
                            ThemeSpec::where('theme_id',$theme_id)->where('category_spec_id',$theme_specs[$i]->category_spec_id)->delete();
                        }

                    }

                }
            }
            else
            {
                $theme_specs->whereIn('category_spec_id',$unwanted_variants)->delete();
            }

        }
        else
        {
            $theme=VariationTheme::create(['category_id'=>$request->category_id,
                'theme_name'=>$request->theme_name]);

            for($i=0;$i<count($request->variants);$i++)
            {
                ThemeSpec::create(['theme_id'=>$theme->theme_id,
                    'category_spec_id'=>$request->variants[$i],
                ]);
            }
        }
        flash('Variants updated successfully')->important()->success();
        return redirect()->route('admin.category.variation');
    }
    /*public function deleteVariant(Request $request)
    {
        $res= ThemeSpec::with('variation_specs')->where('theme_id',$request->theme_id)->
        where('is_deleted','0')->get();

        if(count($res))
        {
            for($i=0;$i<count($res);$i++)
            {
                if(count($res[$i]->variation_specs))
                {
                    return response()->json('Unable to delete !!');
                }
                else
                {
                    VariationTheme::where('theme_id',$request->theme_id)->delete();
                    return response()->json('Delete Successfully !!');
                }
            }
        }
        else
        {
            VariationTheme::where('theme_id',$request->theme_id)->delete();
            return response()->json('Delete Successfully !!');
        }



    }*/

    public function deleteVariant(Request $request)
    {
        $res = ThemeSpec::where('theme_id', $request->theme_id)->
        where('is_deleted', '0')->get()->pluck('theme_spec_id')->toArray();

        if(count($res))
        {
            $result = VariationSpec::whereIn('theme_spec_id', $res)->get();
            if (!count($result))
            {
                try
                {
                    ThemeSpec::where('theme_id', $request->theme_id)->delete();
                    VariationTheme::where('theme_id', $request->theme_id)->delete();
                    return response()->json('Delete successfully !!');
                }
                catch(\Exception $e)
                {
                    return response()->json('Unable to delete !!');
                }

            }
            else
            {
                return response()->json('Unable to delete !!');
            }
        }
        else
        {
            try
            {
                VariationTheme::where('theme_id', $request->theme_id)->delete();
                return response()->json('Delete successfully !!');
            }
            catch(\Exception $e)
            {
                return response()->json('Unable to delete !!');
            }

        }

    }

    public function updateIsDeleted(Request $request)
    {
        $theme_id=$request->theme_id;
        if($request->status==0)
        {
            VariationTheme::where('theme_id',$theme_id)->update(array('is_deleted'=>'1'));
        }
        else
        {
            VariationTheme::where('theme_id',$theme_id)->update(array('is_deleted'=>'0'));
        }
        return response()->json(true);
    }
}
