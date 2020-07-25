<?php
/**
 * Created by.
 * User: Jim
 * Date: 2020/7/17
 * Time: 9:56
 */

namespace app\admin\libs\traits;


use think\Exception;
use think\exception\PDOException;

/**
 * 后台基础方法
 * Trait Backend
 * @package app\admin\libs\traits
 */
trait Backend
{
    public function index()
    {
        return $this->fetch();
    }

    public function add()
    {
        return $this->fetch();
    }

    public function edit($id=null)
    {
        if (!$id) $this->_error('Parameter cannot be empty');

        $data = $this->model->get($id);
        $this->assign(compact('data'));
        return $this->fetch();
    }

    /**
     * 可能存在问题
     * @param null $ids 17 / 12,1,2,11
     */
    public function delete($ids = null)
    {
        Db::startTrans();
        try {
            if ($ids == null) _error('ID不能为空');
            $ids = explode(',', $ids);
            $result = $this->model->destroy($ids);
            Db::commit();
            $result ? _success('删除成功') : _error('删除失败');
        } catch (PDOException $e) {
            Db::rollback();
            _error($e->getMessage());
        } catch (Exception $e) {
            Db::rollback();
            _error($e->getMessage());
        }

    }

    public function store()
    {
        if ($this->request->isPost()) {
            Db::startTrans();
            try {
                $params = $this->request->param('row/a');
                if (!$this->_validate->scene('store')->check($params)) {
                    _error($this->_validate->getError());
                }
                $result = $this->model->allowFIeld(true)->save($params);
                Db::commit();
                $result ? $this->_success('添加成功') : $this->_error('添加失败');


            } catch (PDOException $e) {
                Db::rollback();
                _error($e->getMessage());
            } catch (Exception $e) {
                Db::rollback();
                _error($e->getMessage());
            }

        }

    }

    public function update()
    {
        if ($this->request->isPost()) {
            Db::startTrans();
            try {
                $params = $this->request->param('row/a');
                if (!$this->_validate->scene('update')->check($params)) {
                    _error($this->_validate->getError());
                }
                $result = $this->model->allowFIeld(true)->isUpdate(true)->save($params);
                Db::commit();
                $result ? $this->_success('更新成功') : $this->_error('更新失败');
            } catch (PDOException $e) {
                Db::rollback();
                _error($e->getMessage());
            } catch (Exception $e) {
                Db::rollback();
                _error($e->getMessage());
            }

        }

    }


    /**
     * 回收站页面
     */
    public function recyclebin(){
        // 显示软删除的数据出来

    }

    /**
     * 还原 软删除的数据
     */
    public function restore($ids = ''){
        $pk = $this->model->getPk();
        $adminIds = $this->getDataLimitAdminIds();
        if (is_array($adminIds)) {
            $this->model->where($this->dataLimitField, 'in', $adminIds);
        }
        if ($ids) {
            $this->model->where($pk, 'in', $ids);
        }
        $count = 0;
        Db::startTrans();
        try {
            $list = $this->model->onlyTrashed()->select();
            foreach ($list as $index => $item) {
                $count += $item->restore();
            }
            Db::commit();
        } catch (PDOException $e) {
            Db::rollback();
            $this->error($e->getMessage());
        } catch (Exception $e) {
            Db::rollback();
            $this->error($e->getMessage());
        }
        if ($count) {
            $this->success();
        }
        $this->error(__('No rows were updated'));
    }


    /**
     * 信息列表
     */
    public function lists()
    {
        $_where = $this->model->search();
        if ($_where['code']  == 1){
            $lists = $this->model->where($_where['w'])->paginate();

        }else{
            // 页数
            $lists = $this->model->paginate();
        }
        _lists($lists);
    }

}