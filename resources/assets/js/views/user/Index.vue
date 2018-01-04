<template>
    <div class="content">
        <div class="content-title">
            <h3>用户管理</h3>
        </div>
        <div class="operate" slot="buttons">
            <router-link to="/admin/users/create" class="btn btn-primary">创建用户<i class="el-icon-edit-outline el-icon-right"></i></router-link>
        </div>
        <el-table
                :data="userList"
                border
                style="width: 100%;">
            <el-table-column
                    type="index"
                    width="50">
            </el-table-column>
            <el-table-column
                    prop="name"
                    label="姓名">
            </el-table-column>
            <el-table-column
                    prop="email"
                    label="邮箱">
            </el-table-column>
            <el-table-column
                    prop="introduce"
                    label="简介">
            </el-table-column>
            <el-table-column
                    prop="created_at"
                    label="注册时间">
            </el-table-column>
            <el-table-column
                    label="帐号状态"
                    width="100">
                <template slot-scope="scope">
                    <el-switch
                            v-model="scope.row.status"
                            active-value="1"
                            inactive-value="0"
                            active-color="#13ce66"
                            disabled>
                    </el-switch>
                </template>
            </el-table-column>
            <el-table-column label="操作" width="200">
                <template slot-scope="scope">
                    <el-button
                            size="mini"
                            type="primary"
                            @click="editUser(scope.row)">编辑</el-button>
                    <el-button
                            size="mini"
                            type="danger"
                            @click="deleteUser(scope.row)">删除</el-button>
                </template>
            </el-table-column>
        </el-table>

        <div class="block" v-if="totalPage >= 1">
            <el-pagination
                    @current-change="handleCurrentChange"
                    :current-page.sync="currentPage"
                    :page-size="pageSize"
                    layout="total, prev, pager, next"
                    :total="total">
            </el-pagination>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                userList: undefined,
                currentPage: 1,
                totalPage: 0,
                total: 0,
                pageSize: 10
            }
        },
        created() {
            this.loadUser();
        },
        methods: {
            /**
             * 加载用户列表
             * @param page
             */
            loadUser: function (page) {
                var self = this;
                var url = page ? '/user?page=' + page : '/user';
                this.$http.get(url)
                        .then(function (response) {
                            if (response.data.success) {
                                self.userList = response.data.data.data;
                                self.totalPage = response.data.data.last_page;
                                self.total = response.data.data.total;
                                self.pageSize = response.data.data.per_page;
                            }
                        })
            },
            /**
             * 编辑用户
             */
            editUser: function (row) {
                this.$router.push({
                    path: 'users/' + row.id + '/edit'
                });
            },
            /**
             * 删除用户
             * @param row
             */
            deleteUser: function (row) {
                var self = this;
                self.$confirm('此操作将从数据库中永久删除, 请确认是否继续?', '疯狂提醒中...', {
                            confirmButtonText: '继续',
                            cancelButtonText: '取消',
                            type: 'warning'
                        }
                ).then(() => {
                    this.$http.post('/user/delete/' + row.id)
                            .then(function (response) {
                                if (response.data.success) {
                                    self.loadUser(self.currentPage);
                                }
                                self.$message({
                                    message: response.data.message,
                                    type: response.data.success ? 'success' : 'error',
                                    showClose: true
                                });
                            })
                    }
                ).catch(() => {
                });
            },
            // 翻页
            handleCurrentChange(val) {
                this.currentPage = val;
                this.loadUser(val);
            }
        }
    }
</script>